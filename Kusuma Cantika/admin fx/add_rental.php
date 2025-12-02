<?php
/*
  rental_a_firstitem.php
  - UI: multi-item (Tailwind) — user bisa tambah banyak baris di form
  - Backend: hanya mengambil ITEM PERTAMA (first non-empty item) saat INSERT ke tabel `rental`
  - Sesuai struktur tabel rental:
    (customer_id, costume_id, start_date, end_date, quantity, total_amount, payment_status, status, penalty_fee)
  - Tidak ada stock / rental_items
  - Filter kostum berdasarkan availability tanggal
*/

include 'config.php';

function getAvailableCostumes($conn, $start_date = null, $end_date = null){
    $out=[];
    $sql = "SELECT costume_id, costume_name, price FROM costume";

    if($start_date && $end_date){
        // exclude costumes that are already rented in the selected period
        $sql .= " WHERE costume_id NOT IN (
            SELECT costume_id FROM rental 
            WHERE (start_date <= ? AND end_date >= ?)
        )";
        $stmt = $conn->prepare($sql . " ORDER BY costume_name");
        $stmt->bind_param('ss', $end_date, $start_date);
        $stmt->execute();
        $res = $stmt->get_result();
        while($r = $res->fetch_assoc()) $out[] = $r;
        $stmt->close();
    } else {
        $q = $conn->query($sql . " ORDER BY costume_name");
        while($r = $q->fetch_assoc()) $out[] = $r;
    }

    return $out;
}

$start_date = $_POST['start_date'] ?? null;
$end_date = $_POST['end_date'] ?? null;
$costumes = getAvailableCostumes($conn, $start_date, $end_date);

$errors = [];
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $conn->begin_transaction();
    try{
        // --- CUSTOMER: existing or new ---
        $use_existing = isset($_POST['use_existing']) && $_POST['use_existing'] === '1';
        if($use_existing){
            $customer_id = intval($_POST['customer_id_existing']);
            if($customer_id <= 0) throw new Exception('Pilih pelanggan lama.');
        } else {
            $cname = trim($_POST['customer_name'] ?? '');
            $gender = $_POST['gender'] ?? 'male';
            $phone  = trim($_POST['phone_number'] ?? '');
            $addr   = trim($_POST['address'] ?? '');
            if($cname === '') throw new Exception('Nama pelanggan wajib.');
            $stmt = $conn->prepare("INSERT INTO customer (customer_name, gender, phone_number, address) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $cname, $gender, $phone, $addr);
            if(!$stmt->execute()) throw new Exception('Gagal menyimpan pelanggan: '.$stmt->error);
            $customer_id = $stmt->insert_id;
            $stmt->close();
        }

        // --- Rental dates & meta ---
        $start_date = $_POST['start_date'] ?? null;
        $end_date   = $_POST['end_date'] ?? null;
        if(!$start_date || !$end_date) throw new Exception('Tanggal mulai & kembali harus diisi.');

        $payment_status = $_POST['payment_status'] ?? 'unpaid';
        $status = $_POST['status'] ?? 'booked';
        $penalty_fee = intval($_POST['penalty_fee'] ?? 0);

        // --- ITEMS: arrays from form ---
        $item_costume = $_POST['item_costume'] ?? [];
        $item_qty     = $_POST['item_qty'] ?? [];

        $total_inserted = 0;

        for($i=0;$i<count($item_costume);$i++){
            $cid = intval($item_costume[$i]);
            $qty = intval($item_qty[$i] ?? 0);

            if($cid <= 0 || $qty <= 0) continue;

            $stmt = $conn->prepare("SELECT price FROM costume WHERE costume_id = ?");
            $stmt->bind_param('i', $cid);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows === 0) throw new Exception("Kostum tidak ditemukan (ID: $cid)");
            $c = $res->fetch_assoc();
            $price = (float)$c['price'];
            $stmt->close();

            // check if costume is available in selected dates
            $stmt2 = $conn->prepare("SELECT COUNT(*) as cnt FROM rental WHERE costume_id = ? AND start_date <= ? AND end_date >= ?");
            $stmt2->bind_param('iss', $cid, $end_date, $start_date);
            $stmt2->execute();
            $res2 = $stmt2->get_result()->fetch_assoc();
            $stmt2->close();

            if($res2['cnt'] > 0) throw new Exception("Kostum ID $cid sudah dirental di periode ini.");

            $subtotal = $price * $qty;
            $total_amount = (int) round($subtotal);

            $stmt = $conn->prepare("INSERT INTO rental (customer_id, costume_id, start_date, end_date, quantity, total_amount, payment_status, status, penalty_fee) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param(
                'iissiiisi',
                $customer_id,
                $cid,
                $start_date,
                $end_date,
                $qty,
                $total_amount,
                $payment_status,
                $status,
                $penalty_fee
            );
            if(!$stmt->execute()) throw new Exception('Gagal menyimpan item rental: '.$stmt->error);
            $stmt->close();

            $total_inserted++;
        }

        if($total_inserted === 0){
            throw new Exception('Minimal pilih 1 item dengan jumlah > 0.');
        }

        $conn->commit();
        $success = "Berhasil menyimpan $total_inserted item rental.";
    } catch(Exception $e){
        $conn->rollback();
        $errors[] = $e->getMessage();
    }
}
?>

<!-- HTML dan JS tetap sama, hanya pastikan $costumes sudah difilter berdasarkan tanggal -->

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Tambah Rental (UI multi, backend: first item)</title>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4 text-orange-500">Form Tambah Rental</h1>

    <?php if($success): ?>
      <div class="bg-green-50 border border-green-200 p-3 rounded mb-4 text-green-700"><?=htmlspecialchars($success)?></div>
    <?php endif; ?>

    <?php if(count($errors)): ?>
      <div class="bg-red-50 border border-red-200 p-3 rounded mb-4">
        <?php foreach($errors as $err) echo '<div class="text-red-700">'.htmlspecialchars($err)."</div>"; ?>
      </div>
    <?php endif; ?>

    <form method="POST" id="rentalForm">
      <!-- Customer selection -->
      <div class="mb-4">
        <label class="font-semibold">Pelanggan</label>
        <div class="mt-2 space-x-3">
          <label><input type="radio" name="use_existing" value="1" id="opt_existing" checked> Pelanggan Lama</label>
          <label><input type="radio" name="use_existing" value="0" id="opt_new"> Pelanggan Baru</label>
        </div>

        <div id="existing_box" class="mt-3">
          <select name="customer_id_existing" class="w-full p-2 border rounded">
            <option value="">-- Pilih Pelanggan --</option>
            <?php
              $res = $conn->query("SELECT customer_id, customer_name FROM customer ORDER BY customer_name");
              while($r = $res->fetch_assoc()){
                echo '<option value="'.intval($r['customer_id']).'">'.htmlspecialchars($r['customer_name'])."</option>";
              }
            ?>
          </select>
        </div>

        <div id="new_box" class="mt-3 hidden">
          <input type="text" name="customer_name" placeholder="Nama pelanggan" class="w-full p-2 border rounded mb-2">
          <div class="grid grid-cols-2 gap-2">
            <select name="gender" class="p-2 border rounded">
              <option value="male">Laki-laki</option>
              <option value="female">Perempuan</option>
            </select>
            <input type="text" name="phone_number" placeholder="No HP" class="w-full p-2 border rounded mb-2">
            <input type="text" name="address" placeholder="Alamat" class="w-full p-2 border rounded mb-2">
          </div>
        </div>
      </div>

      <!-- Tanggal Rental -->
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="font-semibold">Tanggal Mulai</label>
          <input type="date" name="start_date" class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="font-semibold">Tanggal Kembali</label>
          <input type="date" name="end_date" class="w-full p-2 border rounded">
        </div>
      </div>

      <!-- Multi Items -->
      <h2 class="font-bold text-lg mt-4 mb-2 text-orange-500">Kostum yang Dipinjam</h2>
      <table class="w-full mb-4" id="items_table">
        <thead>
          <tr class="bg-gray-200">
            <th class="p-2">Kostum</th>
            <th class="p-2">Qty</th>
            <th class="p-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2">
              <select name="item_costume[]" class="w-full p-2 border rounded">
                <option value="">-- Pilih Kostum --</option>
                <?php foreach($costumes as $c){ echo '<option value="'.$c['costume_id'].'" data-price="'.$c['price'].'">'.htmlspecialchars($c['costume_name']).'</option>'; } ?>
              </select>
            </td>
            <td class="p-2">
              <input type="number" name="item_qty[]" class="p-2 border rounded w-full" min="1" value="1">
            </td>
            <td class="p-2 text-center">
              <button type="button" class="bg-red-500 text-white px-3 py-1 rounded remove-row">X</button>
            </td>
          </tr>
        </tbody>
      </table>

      <button type="button" id="addItem" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">+ Tambah Kostum</button>

      <div class="mb-4">
        <label class="font-semibold">Total Harga</label>
        <input type="text" id="grand_total" class="w-full p-2 border rounded bg-gray-100 font-bold" value="0" readonly>
      </div>

      <!-- Status dll -->
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="font-semibold">Status</label>
          <select name="status" class="w-full p-2 border rounded">
            <option value="booked">Booked</option>
            <option value="borrowed">Borrowed</option>
            <option value="returned">Returned</option>
          </select>
        </div>
        <div>
          <label class="font-semibold">Status Pembayaran</label>
          <select name="payment_status" class="w-full p-2 border rounded">
          <option value="paid">Paid</option>
          <option value="unpaid">Unpaid</option>
            
          </select>
        </div>
      </div>

      <label class="font-semibold">Denda (Opsional)</label>
      <input type="number" name="penalty_fee" class="w-full p-2 border rounded mb-4" value="0">

      <button type="submit" class="w-full bg-orange-500 text-white p-3 rounded text-lg font-bold">Simpan Rental</button>
    </form>
  </div>

<script>
// toggle pelanggan
const opt_existing = document.getElementById('opt_existing');
const opt_new = document.getElementById('opt_new');
const box_existing = document.getElementById('existing_box');
const box_new = document.getElementById('new_box');

function toggleCustomer(){
  if(opt_existing.checked){ box_existing.classList.remove('hidden'); box_new.classList.add('hidden'); }
  else { box_existing.classList.add('hidden'); box_new.classList.remove('hidden'); }
}
opt_existing.onclick = toggleCustomer;
opt_new.onclick = toggleCustomer;

// add item row
const addItem = document.getElementById('addItem');
addItem.onclick = () =>{
  const tbody = document.querySelector('#items_table tbody');
  const row = document.createElement('tr');
  row.innerHTML = `
    <td class='p-2'>
      <select name='item_costume[]' class='w-full p-2 border rounded'>
        <option value=''>-- Pilih Kostum --</option>
        <?php foreach($costumes as $c){ echo '<option value="'.$c['costume_id'].'" data-price="'.$c['price'].'">'.htmlspecialchars($c['costume_name']).'</option>'; } ?>
      </select>
    </td>
    <td class='p-2'>
      <input type='number' name='item_qty[]' class='p-2 border rounded w-full' value='1' min='1'>
    </td>
    <td class='p-2 text-center'>
      <button type='button' class='bg-red-500 text-white px-3 py-1 rounded remove-row'>X</button>
    </td>`;
  tbody.appendChild(row);
  hitungTotal(); // langsung hitung setelah tambah row
};

document.addEventListener('click', e=>{
  if(e.target.classList.contains('remove-row')){
    e.target.closest('tr').remove();
    hitungTotal();
  }
});

// hitung total harga
function hitungTotal(){
  let total = 0;
  document.querySelectorAll('#items_table tbody tr').forEach(row => {
    const select = row.querySelector("select[name='item_costume[]']");
    const qtyInput = row.querySelector("input[name='item_qty[]']");
    const qty = parseInt(qtyInput?.value) || 0;

    if(select && qty > 0){
      const priceAttr = select.options[select.selectedIndex]?.getAttribute('data-price') || '0';
      const price = parseFloat(priceAttr.replace(/,/g, '')) || 0;
      total += price * qty;
    }
  });

  const el = document.getElementById('grand_total');
  if(el){ el.value = total.toLocaleString('id-ID'); }
}

// recalc ketika select atau qty berubah
document.addEventListener('change', e => {
  if(e.target.name === 'item_costume[]' || e.target.name === 'item_qty[]'){
    hitungTotal();
  }
});

// initial calc
hitungTotal();
</script>
</body>
</html>
