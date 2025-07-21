 <?= $this->extend('App\Views\admin\template') ?>

 <?= $this->section('head_end') ?>
 <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/b-print-3.2.4/cc-1.0.7/date-1.5.6/fc-5.0.4/fh-4.0.3/r-3.0.5/rg-1.5.2/sc-2.4.3/sb-1.8.3/sp-2.3.4/sl-3.0.1/datatables.min.css" rel="stylesheet" integrity="sha384-ede0yB+Ead2DmvzMNh7/50ZpKFl2K/4/h70Qn+RvKbYCm/1eeLv4sjsPQFSN+MPO" crossorigin="anonymous">
 <?= $this->endSection() ?>

 <?= $this->section('content') ?>
 <div class="card">
     <div class="card-header">
         <div class="d-flex justify-content-between">
             <h6>USER LIST</h6>
             <a href="<?= base_url('admin/user/add') ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                     <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                 </svg>Tambah User</a>
         </div>
     </div>
     <div class="card-body">
         <table id="datatable" class="table table-bordered table-striped">
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
             </tbody>
         </table>
     </div>
 </div>
 <?= $this->endSection() ?>

 <?= $this->section('body_end') ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-html5-3.2.4/b-print-3.2.4/cc-1.0.7/date-1.5.6/fc-5.0.4/fh-4.0.3/r-3.0.5/rg-1.5.2/sc-2.4.3/sb-1.8.3/sp-2.3.4/sl-3.0.1/datatables.min.js" integrity="sha384-GYnVi5xKX+aPLEGNA5UZILjLym+shrnueixcao8AC8OEks2RC1gT445TjvEEvRbV" crossorigin="anonymous"></script>


 <script>
     let table = new DataTable('#datatable', {
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "ajax": {
             "url": "<?php echo base_url('admin/user/list/ajax'); ?>",
             "type": "POST"
         },
         "columns": [{
                 "data": null,
                 "orderable": false,
                 "searchable": false,
                 "render": function(data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                 }
             },
             {
                 "data": 'username'
             },
             {
                 "data": 'email'
             },
             {
                 "data": 'full_name'
             },
             {
                 "data": null,
                 "render": function(data, type, row) {
                     return `
                    <a class="btn btn-primary btn-sm edit" href="/admin/user/edit/${row['id']}"><i class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-danger btn-sm delete" data-id="${row['id']}" onclick="deleteModal(${row['id']})"><i class="bi bi-trash3-fill"></i></button>
                `;
                 },
                 "orderable": false
             }
         ]
     });
     <?php if (isset($message) && $message != "") { ?>
         Toast.fire({
             title: "<?= $message ?>"
         });
     <?php } ?>

     const deleteModal = (id) => {
         Swal.fire({
             title: "Hapus Data?",
             text: "Anda akan menghapus data ini, lanjutkan?",
             showCancelButton: true,
             confirmButtonText: "Hapus",
             cancelButtonText: `Batal`,
             showLoaderOnConfirm: true,
             preConfirm: async (login) => {
                 try {
                     const urlDelete = "/admin/user/delete/" + id;
                     const response = await fetch(urlDelete, {
                         method: 'delete'
                     });
                     if (!response.ok) {
                         return Swal.showValidationMessage(`
          ${JSON.stringify(await response.json())}
        `);
                     }
                     return response.json();
                 } catch (error) {
                     Swal.showValidationMessage(`
        Request failed: ${error}
      `);
                 }
             },
             allowOutsideClick: () => !Swal.isLoading()
         }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
                 Toast.fire({title: result.value.message, icon: result.value.status == 'success' ? 'success' : 'error'});
                 table.ajax.reload();
             }
         });
     }
 </script>
 <?= $this->endSection() ?>