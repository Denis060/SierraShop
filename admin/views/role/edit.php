<?php require('admin/views/shared/header.php'); ?>
<?php require('admin/views/shared/loader.php'); ?>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<?php require('admin/views/shared/formsearch.php'); ?>
<?php require('admin/views/shared/rightnavbar.php'); ?>
<?php require('admin/views/shared/leftnavbar.php'); ?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Role Information</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> SierraShop</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=role">Role</a></li>
                        <li class="breadcrumb-item active">Edit Access Role</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <h2 style="font-weight: bold;">Edit Role Description</h2>
                <div class="col-lg-12">
                    <form id="product-form" class="form-horizontal" method="post" action="admin.php?controller=role&amp;action=edit" enctype="multipart/form-data" role="form">
                        <input name="role_id" type="hidden" value="<?= $role ? $role['id'] : '0'; ?>" />
                        <h4 class="card-inside-title" style="font-weight:bold;">Role Name</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="name" type="text" maxlength="255" value="<?= $role ? $role['role_name'] : ''; ?>" class="form-control" id="name" placeholder="e.g.: admin, mod, super mod..." required=""/>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Description for this Role:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="description" maxlength="500" type="text" value="<?= $role ? $role['role_desc'] : ''; ?>" class="form-control" id="name" placeholder="Enter a description..." required="" />
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group" style="text-align: center;">
                            <button class="btn btn-primary waves-effect" type="submit">Update Role Information</button>
                            <a class="btn btn-warning waves-effect" href="admin.php?controller=role">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require('admin/views/shared/footer.php'); ?>
