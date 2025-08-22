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
                    <h2>Your Personal Account Information</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> ChiKoi</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=user&action=listall">User</a></li>
                        <li class="breadcrumb-item active">Edit Your Profile Info</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <h3>Personal Account Information</h3>
                        <table id="info" class="table">
                            <tr>
                                <td><strong>Full Name</strong></td>
                                <td><?= $user_info['user_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Username</strong> </td>
                                <td><?= $user_info['user_username']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Role</strong> </td>
                                <td><strong><?php if ($user_info['role_id'] == 0) {
                                    echo 'User';
                                } elseif ($user_info['role_id'] == 1) {
                                    echo 'Admin';
                                } else {
                                    echo 'Moderator';
                                } ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong> </td>
                                <td><?= $user_info['user_email']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong> </td>
                                <td><?= $user_info['user_address']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong> </td>
                                <td><?= $user_info['user_phone']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Account Creation Date</strong> </td>
                                <td><?= $user_info['createDate']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Avatar</strong> </td>
                                <td><img style="max-width:200px;" src="public/upload/images/<?= $user_info['user_avatar']; ?>" alt="<?= $user_info['user_name']; ?>"> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <h2 style="font-weight: bold;">Edit the Above Personal Information</h2>
                <div class="col-lg-12">
                    <form id="product-form" class="form-horizontal" method="post" action="admin.php?controller=user&action=edit" enctype="multipart/form-data" role="form">
                        <input name="user_id" type="hidden" value="<?= $user_info ? $user_info['id'] : '0'; ?>" />
                        <?php if ($loginUser['role_id'] == 1) : ?>
                            <h4 class="card-inside-title" style="font-weight:bold;">Username:</h4>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="username" type="text" maxlength="50" value="<?= $user_info ? $user_info['user_username'] : ''; ?>" class="form-control" id="name" placeholder="e.g. johndoe" required="" />
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title" style="font-weight:bold;">Select Role:</h2>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3 form-group">
                                        <select name="roleid" required class="form-control show-tick">
                                            <option value="0">User</option>
                                            <option value="2">Moderator</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <h4 class="card-inside-title" style="font-weight:bold;">Username: "<?= $user_info['user_username'] ?>"</h4>
                            <input name="username" type="hidden" value="<?= $user_info ? $user_info['user_username'] : ''; ?>" class="form-control" />
                        <?php endif; ?>
                        <h4 class="card-inside-title" style="font-weight:bold;">Full Name:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="name" type="text" maxlength="250" value="<?= $user_info ? $user_info['user_name'] : ''; ?>" class="form-control" id="name" placeholder="Full name..." required="" />
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Email:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="email" type="email" maxlength="250" value="<?= $user_info ? $user_info['user_email'] : ''; ?>" class="form-control" id="color" placeholder="Enter your email..." required="" />
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Enter Address:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="address" type="text" maxlength="250" value="<?= $user_info ? $user_info['user_address'] : ''; ?>" class="form-control" id="material" placeholder="User address..." required="" />
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Enter Phone Number:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="phone" type="text" pattern="[0-9\.]+" maxlength="20" value="<?= $user_info ? $user_info['user_phone'] : ''; ?>" class="form-control" id="totalview" required placeholder="0123456789..." />
                                </div>
                            </div>
                        </div>
                        <h4 class="card-inside-title" style="font-weight:bold;">Select New Avatar Image:</h4>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <input name="imagee" type="file" class="form-control dropify">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group" style="text-align: center;">
                            <button class="btn btn-primary waves-effect" type="submit">Update User Information</button>
                            <a class="btn btn-primary waves-effect" href="admin.php?controller=user&action=change-password&amp;user_id=<?= $user_info['id']; ?>">Change Password</a>
                            <a class="btn btn-warning waves-effect" href="admin.php?controller=user&action=listall">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require('admin/views/shared/footer.php'); ?>
