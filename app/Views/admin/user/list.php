 <?= $this->extend('App\Views\admin\template') ?>

 <?= $this->section('head_end') ?>
 <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
 <?= $this->endSection() ?>

 <?= $this->section('content') ?>
 <div class="card">
     <div class="card-header">
         <div class="d-flex justify-content-between">
             <h6>USER LIST</h6>
             <a href="#" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                     <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                 </svg>Tambah User</a>
         </div>
     </div>
     <div class="card-body">
         <table id="datatable">
             <thead>
                 <tr>
                     <th width="5%">No</th>
                     <th>Username</th>
                     <th>Email</th>
                     <th>Nama</th>
                     <th>Aksi</th>
                 </tr>
             </thead>
             <tbody>
                <?php foreach($datalist as $data): ?>
                    <tr>
                        <td>1</td>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['full_name'] ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
                 
             </tbody>
         </table>
     </div>
 </div>
 <?= $this->endSection() ?>

 <?= $this->section('body_end') ?>
 <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

 <script>
     let table = new DataTable('#datatable');
     <?php if(isset($message) && $message != ""){ ?>
        Toast.fire({title: "<?= $message ?>"});
        <?php } ?>
 </script>
 <?= $this->endSection() ?>