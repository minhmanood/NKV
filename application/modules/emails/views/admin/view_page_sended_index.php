<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form name="filter" method="get" action="<?php echo get_admin_url($module_slug); ?>" autocomplete="off">
            <nav class="search_bar navbar navbar-default" role="search">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#filter-bar-7adecd427b033de80d2a0e30cf74e735">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="filter-bar-7adecd427b033de80d2a0e30cf74e735">
                    <div class="navbar-form">
                        <div class="form-group search_title">
                            Số dòng hiển thị
                        </div>
                        <div class="form-group search_input">
                            <select class="form-control input-sm" name="per_page">
                                <?php
                                $records_in_page = 10;
                                for ($i = 1; $i <= 10; $i++) {
                                    $per_page = $i * $records_in_page;
                                    ?>
                                    <?php if (isset($get['per_page']) && $get['per_page'] == $per_page) : ?>
                                        <option selected="selected" value="<?php echo $per_page; ?>"><?php echo $per_page; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $per_page; ?>"><?php echo $per_page; ?></option>
                                    <?php endif; ?>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group search_title">
                            Từ khóa tìm kiếm
                        </div>
                        <div class="form-group search_input">
                            <input class="form-control input-sm" type="text" value="<?php echo isset($get['q']) ? $get['q'] : ''; ?>" maxlength="64" name="q" placeholder="Từ khóa tìm kiếm">
                        </div>

                        <div class="form-group search_action pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
                        </div>
                        <br>
                        <label><em>Từ khóa tìm kiếm không dùng các mã html</em></label>
                    </div>
                </div>
            </nav>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Danh sách email đã gửi</h3>
            </div>
            <div class="box-body">
                <?php if (!empty($rows)): ?>
                    <form class="form-inline" name="main" method="post" action="<?php echo get_admin_url($module_slug . '/' . 'main'); ?>" autocomplete="off">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input class="flat-blue check-all" name="check_all[]" type="checkbox" value="yes">
                                        </th>
                                        <th>Tên người gửi</th>
										<th>Email</th>
										<th>Tiêu đề</th>
                                        <th class="text-center">Ngày gửi</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Ngày cập nhật</th>
                                        <th class="text-center" style="width: 160px;">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="check flat-blue" value="<?php echo $row['id']; ?>" name="idcheck[]">
                                            </td>
                                            <td><?php echo $row['full_name']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['subject']; ?></td>
											<td class="text-center"><?php echo ($row['sended'] > 0 ? display_date($row['sended']) : ''); ?></td>
                                            <td class="text-center"><?php echo display_date($row['created']); ?></td>
                                            <td class="text-center"><?php echo ($row['modified'] > 0 ? display_date($row['modified']) : ''); ?></td>
                                            <td class="text-center">
                                                <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="<?php echo get_admin_url($module_slug . '/delete?id=' . $row['id']); ?>" class="delete_bootbox">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-left">
                                        <td colspan="6">
                                            <div class="input-group">
                                                <select class="form-control" name="action" id="action">
                                                    <option value="delete">Xóa</option>
                                                </select>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit">Thực hiện</button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="callout callout-warning">
                        <h4>Thông báo!</h4>
                        <p><b>Không</b> có email nào!</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (isset($pagination) && trim($pagination) != ''): ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>