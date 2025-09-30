<?php require('admin/views/shared/header.php'); ?>
<?php require('admin/views/shared/loader.php'); ?>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<?php require('admin/views/shared/formsearch.php'); ?>
<?php require('admin/views/shared/leftnavbar.php'); ?>
<?php require('admin/views/shared/rightnavbar.php'); ?>
<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> SierraCart</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($userInfoNav['role_id'] == 0) : ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon sales">
                        <div class="body">
                            <h6>Your Total Orders</h6>
                            <h2><?= $total_order_mine ?> <small class="info">Processing <?= $total_mine_order_inprosess ?> | Completed <?= $total_mine_order_complete ?></small></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon email">
                        <div class="body">
                            <h6>Your Total Feedback</h6>
                            <h2><?= $total_feedback_mine ?> <small class="info">Order Feedback <?= $total_feedback_mine_order ?> | Product Feedback <?= $total_feedback_mine_product ?></small></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>Your Total Comments</h6>
                            <h2><?= $total_mine_comment ?> <small class="info">Not Approved: <?= $total_mine_comment_noaccept ?></small></h2>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon traffic">
                        <div class="body">
                            <h6>Total Pages and Posts</h6>
                            <h2><?= $total_posts ?> <small class="info">Post: <?= $total_post ?> Page: <?= $total_page ?></small></h2>
                            <small>Total published as "Public"</small>
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="<?= $posts_ratio ?>" aria-valuemin="0" aria-valuemax="100" <?= 'style="width:' . $posts_ratio . '%;"' ?>></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon sales">
                        <div class="body">
                            <h6>Total Orders</h6>
                            <h2><?= $total_order ?> <small class="info">Processing <?= $total_order_inprosess ?> | Not Processed <?= $total_order_noprosess ?></small></h2>
                            <small>Order processing and cancelled statistics</small>
                            <div class="progress">
                                <div class="progress-bar l-blue" role="progressbar" aria-valuenow="<?= $order_ratio ?>" aria-valuemin="0" aria-valuemax="100" <?= 'style="width:' . $order_ratio . '%;"' ?>></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon email">
                        <div class="body">
                            <h6>Total Feedback</h6>
                            <h2><?= $total_feedback ?> <small class="info">Order Feedback <?= $total_feedback_order ?> | Product Feedback <?= $total_feedback_product ?></small></h2>
                            <small>Feedback viewed and processed statistics</small>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="<?= $feedback_ratio ?>" aria-valuemin="0" aria-valuemax="100" <?= 'style="width:' . $feedback_ratio . '%;"' ?>></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>Total Comments</h6>
                            <h2><?= $totalRows_comment ?> <small class="info">Not Approved: <?= $total_comment_noaccept ?></small></h2>
                            <small>Accepted comments statistics</small>
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="<?= $comment_ratio ?>" aria-valuemin="0" aria-valuemax="100" <?= 'style="width:' . $comment_ratio . '%;"' ?>></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-lg-8">
                    <?php require('admin/views/order/tableOrderNoprocess.php'); ?>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Statistics <strong>Table</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="admin.php?controller=comment">Manage Comments</a></li>
                                                <li><a href="admin.php?controller=feedback">Manage Feedback</a></li>
                                                <li><a href="admin.php?controller=order">Manage Orders</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Statistics</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="zmdi zmdi-assignment"></i> New Order</td>
                                                    <td><?= getTime($order_new['createtime'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-assignment-alert"></i> Unprocessed Order</td>
                                                    <td><?= $total_order_noprosess ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-assignment-return"></i> Cancelled Order</td>
                                                    <td><?= $total_order_cancell ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-assignment-check"></i> Processing Order</td>
                                                    <td><?= $total_order_inprosess ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-comment-alt-text"></i> New Comment</td>
                                                    <td><?= getTime($comment_new['createDate'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-comment-alert"></i> Unprocessed Comment</td>
                                                    <td><?= $total_comment_noaccept ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-email-open"></i> New Feedback</td>
                                                    <td><?= getTime($feedback_new['createTime'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-email"></i> Unprocessed Feedback</td>
                                                    <td><?= $total_feedback_noaccept ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-reader"></i> New Page</td>
                                                    <td><?= getTime($page_new['post_date'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-tab"></i> Draft Page</td>
                                                    <td><?= $total_page_draft ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-receipt"></i> New Post</td>
                                                    <td><?= getTime($post_new['post_date'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-assignment-o"></i> Draft Post</td>
                                                    <td><?= $total_post_draft ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Recent <strong>Comments Table</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="admin.php?controller=comment">Q/lý bình luận</a></li>
                                                <li><a href="admin.php?controller=feedback">Q/lý phản hồi</a></li>
                                                <li><a href="admin.php?controller=order">Q/lý đơn hàng</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Content</th>
                                                    <th>Sender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($comment_five as $comment) :
                                                    if ($comment['status'] == 0) : ?>
                                                        <tr style="background-color: #FFD18E;">
                                                            <td><?= substr($comment['content'], 0, 150);
                                                        if (strlen($comment['content']) > 150) {
                                                            echo '...';
                                                        } ?> </td>
                                                            <td><?= $comment['author'] ?></td>
                                                            <td><a title="Approve" class="btn btn-info btn-icon" href="admin.php?controller=comment&action=approved&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-check-circle"></i></a>
                                                                <a title="Add Trash" class="btn btn-danger btn-icon" href="admin.php?controller=comment&action=trash-action&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-delete"></i></a>
                                                                <a title="Edit" class="btn btn-warning btn-icon" href="admin.php?controller=comment&action=edit&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-eyedropper"></i></a>
                                                                <a title="Add Spam" class="btn btn-danger btn-icon" href="admin.php?controller=comment&action=spam-action&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-minus-circle"></i></a></td>
                                                        </tr>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td><?= substr($comment['content'], 0, 150);
                                                        if (strlen($comment['content']) > 150) {
                                                            echo '...';
                                                        } ?> </td>
                                                            <td><?= $comment['author'] ?></td>
                                                            <td><a title="Unapprove" class="btn btn-default btn-icon" href="admin.php?controller=comment&action=unapproved&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-minus-circle"></i></a>
                                                                <a title="Add Trash" class="btn btn-danger btn-icon" href="admin.php?controller=comment&action=trash-action&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-delete"></i></a>
                                                                <a title="Edit" class="btn btn-warning btn-icon" href="admin.php?controller=comment&action=edit&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-eyedropper"></i></a>
                                                                <a title="Add Spam" class="btn btn-danger btn-icon" href="admin.php?controller=comment&action=spam-action&comment_id=<?= $comment['id'] ?>"> <i class="zmdi zmdi-minus-circle"></i></a></td>
                                                        </tr>
                                                <?php endif;
                                                endforeach; ?>
                                                <tr>
                                                    <td><strong><a href="admin.php?controller=comment">All</a> (<?= $totalRows_comment ?>) | Mine (<?= $total_mine_comment ?>) | <a href="admin.php?controller=comment&action=pending">Pending</a> (<?= $total_comment_noaccept ?>) | <a href="admin.php?controller=comment">Approved</a> (<?= $total_comment_accept ?>) | <a href="admin.php?controller=comment&action=spam">Spam</a> (<?= $total_comment_spam ?>) | <a href="admin.php?controller=comment&action=trash">Trash</a> (<?= $total_comment_trash ?>)</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Recent <strong>Feedback Table</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="admin.php?controller=comment">Q/lý bình luận</a></li>
                                                <li><a href="admin.php?controller=feedback">Q/lý phản hồi</a></li>
                                                <li><a href="admin.php?controller=order">Q/lý đơn hàng</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Content</th>
                                                    <th>Sender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($feedback_five as $feedback) :
                                                    if ($feedback['status'] == 0) : ?>
                                                        <tr style="background-color: #FFD18E;">
                                                            <td><?= substr($feedback['subject'], 0, 150) ?> </td>
                                                            <td><?= $feedback['name'] ?></td>
                                                            <td>
                                                                <a title="Approve" class="btn btn-info btn-icon" href="admin.php?controller=feedback&action=approved&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-check-circle"></i></a>
                                                                <a onclick="return confirm('Are you sure to delete?')" title="Delete" class="btn btn-danger btn-icon" href="admin.php?controller=feedback&action=delete&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-delete"></i></a>
                                                                <a title="Edit" class="btn btn-warning btn-icon" href="admin.php?controller=feedback&action=edit&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-eyedropper"></i></a><br>
                                                                <a title="View detail" class="btn btn-success btn-icon" href="admin.php?controller=feedback&action=view&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-eye"></i></a>
                                                                <a title="Reply" class="btn btn-primary btn-icon" href="admin.php?controller=feedback&action=reply&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-mail-reply"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td><?= substr($feedback['subject'], 0, 150) ?> </td>
                                                            <td><?= $feedback['name'] ?></td>
                                                            <td>
                                                                <a title="UnApprove" class="btn btn-default btn-icon" href="admin.php?controller=feedback&action=unapproved&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-minus-circle"></i></a>
                                                                <a onclick="return confirm('Are you sure to delete?')" title="Delete" class="btn btn-danger btn-icon" href="admin.php?controller=feedback&action=delete&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-delete"></i></a>
                                                                <a title="Edit" class="btn btn-warning btn-icon" href="admin.php?controller=feedback&action=edit&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-eyedropper"></i></a>
                                                                <a title="View detail" class="btn btn-success btn-icon" href="admin.php?controller=feedback&action=view&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-eye"></i></a>
                                                                <a title="Reply" class="btn btn-primary btn-icon" href="admin.php?controller=feedback&action=reply&feedback_id=<?= $feedback['id'] ?>"> <i class="zmdi zmdi-mail-reply"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php endif;
                                                endforeach; ?>
                                                <tr>
                                                    <td><strong><a href="admin.php?controller=feedback">All</a> (<?= $total_feedback ?>) | <a href="admin.php?controller=feedback&action=myfeedback">Mine</a> (<?= $total_feedback_mine ?>) | <a href="admin.php?controller=feedback&action=pending">Pending</a> (<?= $total_feedback_noaccept ?>) | <a href="admin.php?controller=feedback">Approved</a> (<?= $total_feedback_status ?>)</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-lg-9">
                    <?php require('admin/views/product/tableoUpdateproduct.php'); ?>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Bảng <strong>Thống kê 2</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="admin.php?controller=user&action=listall">Q/lý User</a></li>
                                                <li><a href="admin.php?controller=comment">Manage Comments</a></li>
                                                <li><a href="admin.php?controller=feedback">Manage Feedback</a></li>
                                                <li><a href="admin.php?controller=order">Manage Orders</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Dữ liệu</th>
                                                    <th>Số liệu Thống kê</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="zmdi zmdi-case"></i> Sản phẩm mới</td>
                                                    <td><?= $total_new_product ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-case-download"></i> Sản phẩm khuyến mãi</td>
                                                    <td><?= $total_sale_product ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-case-play"></i> Sản phẩm nổi bật</td>
                                                    <td><?= $total_hot_product ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-case-check"></i> Sản phẩm mới cập nhật</td>
                                                    <td><?= getTime($product_update['editDate'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-account-add"></i> New Users</td>
                                                    <td><?= $user_new['user_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-accounts"></i> Tổng Số lượng User</td>
                                                    <td><?= $user_all_total ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-mood-bad"></i> Tổng User chưa Verified</td>
                                                    <td><?= $user_not_veri_total ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-receipt"></i> Tổng số Bài viết</td>
                                                    <td><?= $total_post ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-reader"></i> Tổng số Trang</td>
                                                    <td><?= $total_page ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-delete"></i> Trang & Bài viết rác</td>
                                                    <td><?= $total_post_trash ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Bảng <strong>Thống kê 3</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="admin.php?controller=user&action=listall">Q/lý User</a></li>
                                                <li><a href="admin.php?controller=comment">Q/lý bình luận</a></li>
                                                <li><a href="admin.php?controller=feedback">Q/lý phản hồi</a></li>
                                                <li><a href="admin.php?controller=order">Q/lý đơn hàng</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Dữ liệu</th>
                                                    <th>Số liệu Thống kê</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="zmdi zmdi-pin-account"></i> User đang online</td>
                                                    <td><?= $users_online_total ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="zmdi zmdi-accounts-outline"></i> Tổng User truy cập</td>
                                                    <td><?= $users_online_all ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php require('admin/views/shared/footer.php'); ?>
