 <?= $this->extend('App\Views\admin\template') ?>

 <?= $this->section('head_end') ?>
 <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

 <?= $this->endSection() ?>

 <?= $this->section('content') ?>
 <div class="row">
     <div class="col-12">
         <div class="card">
             <div class="card-header">
                 <h6>Tambah User Baru</h6>
             </div>
             <form action="<?= $action ?>" method="post" id="myForm">
                 <div class="card-body">
                     <div class="row">
                         <?= isset($errors) ? implode(",", $errors) : "" ?>
                     </div>
                     <div class="row">
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Name <span class="text-danger">*</span></label>
                                 <input type="text" name="full_name" placeholder="Jhon doe" class="form-control" value=<?= $formedit['full_name'] ?? "" ?>>
                             </div>
                         </div>
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Email <span class="text-danger">*</span></label>
                                 <input type="email" name="email" placeholder="jhon@mail.com" class="form-control" value=<?= $formedit['email'] ?? "" ?>>
                             </div>
                         </div>
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Username <span class="text-danger">*</span></label>
                                 <input type="text" name="username" class="form-control" placeholder="jhondoe" value=<?= $formedit['username'] ?? "" ?>>
                             </div>
                         </div>
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Phone <span class="text-danger">*</span></label>
                                 <input type="text" id="phone" class="form-control" name="phone">
                             </div>
                         </div>
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Password <span class="text-danger">*</span></label>
                                 <input type="password" name="password" placeholder="*********" class="form-control">
                             </div>
                         </div>
                         <div class="col-lg-6 mb-3">
                             <div class="form-group">
                                 <label for="">Confirm Password <span class="text-danger">*</span></label>
                                 <input type="password" name="confirm_password" placeholder="*********" class="form-control">
                             </div>
                         </div>
                         <div class="col-lg-12 mb-3">
                             <div class="form-group">
                                 <label for="">Address</label>
                                 <textarea name="address" class="form-control" placeholder="User address" rows="10"><?= $formedit['address'] ?? "" ?></textarea>
                             </div>
                         </div>
                         <div class="col-lg-12 mb-3">
                             <div class="form-group">
                                 <label for="" class="form-label">Groups/Role</label>
                                 <div class="d-flex align-items-center gap-3">
                                     <?php foreach ($group_lists as $key => $group): ?>
                                         <div class="form-check">
                                             <input class="form-check-input" type="checkbox" name="groups[]" value="<?= $key ?>">
                                             <label class="form-check-label">
                                                 <?= $group['title'] ?>
                                             </label>
                                         </div>
                                     <?php endforeach; ?>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card-footer">
                     <div class="d-flex w-100 justify-content-end gap-2">
                         <button class="btn btn-danger">Batal</button>
                         <button class="btn btn-primary">Simpan</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <?= $this->endSection() ?>

 <?= $this->section('body_end') ?>
 <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
 <script src="<?= ASSETS_ADMIN ?>/plugins/cleavejs/cleave.min.js"></script>
 <script src="<?= ASSETS_ADMIN ?>/plugins/cleavejs/addons/cleave-phone.id.js"></script>

 <script>
     let plain_phone = document.querySelector("#phone_plain");
     let phone = new Cleave('#phone', {
         phone: true,
         phoneRegionCode: 'id',
         swapHiddenInput: true
     })
 </script>

 <?= $this->endSection() ?>