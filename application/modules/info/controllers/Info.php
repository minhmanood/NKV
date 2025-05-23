<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
include_once APPPATH . '/modules/layout/controllers/Layout.php';
class Info extends Layout
{

    private $_module_slug = 'info';
    private $_path = 'uploads/info/';

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('info/m_info', 'M_info');
        $this->_data['module_slug'] = $this->_module_slug;
        $this->_data['breadcrumbs_module_name'] = 'Thông Tin';

        //tạo uploads/info nếu chưa có
        if (!is_dir($this->_path)) {
            mkdir($this->_path, 0777, true);
        }
    }

    function admin_ajax_change_status()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $value = $this->input->post('value');
            $id = $this->input->post('id');
            $data = array(
                'status' => $value
            );
            if ($this->M_info->update($id, $data)) {
                if ($value == 1) {
                    $notify_type = 'success';
                    $notify_content = 'Đã bật hiển thị thông tin!';
                } else {
                    $notify_type = 'warning';
                    $notify_content = 'Đã tắt hiển thị thông tin!';
                }
            } else {
                $notify_type = 'danger';
                $notify_content = 'Dữ liệu chưa lưu!';
            }
            $this->set_notify_admin($notify_type, $notify_content);
            $this->load->view('layout/notify-ajax', NULL);
        } else {
            redirect(base_url());
        }
    }

    function default_args()
    {
        $order_by = array(
            'post_type' => 'ASC',
            'order' => 'ASC'
        );
        $args = array();
        $args['order_by'] = $order_by;

        return $args;
    }

    function counts($options = array())
    {
        $default_args = $this->default_args();

        if (is_array($options) && !empty($options)) {
            $args = array_merge($default_args, $options);
        } else {
            $args = $default_args;
        }

        return $this->M_info->counts($args);
    }

    function get($id = 0)
    {
        return $this->M_info->get($id);
    }

    function gets($options = array())
    {
        $default_args = $this->default_args();

        if (is_array($options) && !empty($options)) {
            $args = array_merge($default_args, $options);
        } else {
            $args = $default_args;
        }

        return $this->M_info->gets($args);
    }

    function get_by($options = array())
    {
        $default_args = $this->default_args();

        if (is_array($options) && !empty($options)) {
            $args = array_merge($default_args, $options);
        } else {
            $args = $default_args;
        }

        return $this->M_info->get_by($args);
    }

    function get_max_order($post_type = 'all')
    {
        $args = $this->default_args();
        $order_by = array(
            'order' => 'DESC'
        );
        $args['order_by'] = $order_by;
        $args['post_type'] = $post_type;
        $rows = $this->M_info->gets($args);

        return isset($rows[0]['order']) ? $rows[0]['order'] : 0;
    }

    function re_order($post_type = 'all')
    {
        $args = $this->default_args();
        $order_by = array(
            'order' => 'ASC',
        );
        $args['order_by'] = $order_by;
        $args['post_type'] = $post_type;
        $rows = $this->M_info->gets($args);
        if (is_array($rows) && !empty($rows)) {
            $i = 0;
            foreach ($rows as $value) {
                $i++;
                $data = array(
                    'order' => $i,
                );
                $this->M_info->update($value['id'], $data);
            }
        }
    }

    function get_by_type($post_type = 'all', $single = false)
    {
        return $this->M_info->get_by_type($post_type, $single);
    }

    function admin_index()
    {
        $this->_initialize_admin();
        $this->redirect_admin();

        $this->_plugins_css_admin[] = array(
            'folder' => 'bootstrap3-dialog/css',
            'name' => 'bootstrap-dialog'
        );
        $this->_plugins_script_admin[] = array(
            'folder' => 'bootstrap3-dialog/js',
            'name' => 'bootstrap-dialog'
        );
        $this->set_plugins_admin();

        $this->_modules_script[] = array(
            'folder' => 'info',
            'name' => 'admin-items'
        );
        $this->set_modules();

        $get = $this->input->get();
        $this->_data['get'] = $get;

        $args = $this->default_args();
        if (isset($get['post_type']) && trim($get['post_type']) != '') {
            $args['post_type'] = $get['post_type'];
        }
        if (isset($get['q']) && trim($get['q']) != '') {
            $args['q'] = $get['q'];
        }

        $total = $this->counts($args);
        $perpage = isset($get['per_page']) ? $get['per_page'] : $this->config->item('per_page');
        $segment = 3;

        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['full_tag_open'] = '<ul class="pagination no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Trang trước &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Trang sau';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        if (!empty($get)) {
            $config['base_url'] = get_admin_url($this->_module_slug);
            $config['suffix'] = '?' . http_build_query($get, '', "&");
            $config['first_url'] = get_admin_url($this->_module_slug . '?' . http_build_query($get, '', "&"));
            $config['uri_segment'] = $segment;
        } else {
            $config['base_url'] = get_admin_url($this->_module_slug);
            $config['uri_segment'] = $segment;
        }

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);

        $this->_data['rows'] = $this->M_info->gets($args, $perpage, $offset);
        $this->_data['pagination'] = $pagination;

        $this->_data['title'] = 'Danh sách thông tin - ' . $this->_data['title'];
        $this->_data['main_content'] = 'info/admin/view_page_index';
        $this->load->view('layout/admin/view_layout', $this->_data);
    }

    function admin_content()
    {
        $this->_initialize_admin();
        $this->redirect_admin();

        $this->_plugins_script_admin[] = array(
            'folder' => 'jquery-validation',
            'name' => 'jquery.validate'
        );
        $this->_plugins_script_admin[] = array(
            'folder' => 'jquery-validation/localization',
            'name' => 'messages_vi'
        );

        $this->_plugins_css_admin[] = array(
            'folder' => 'bootstrap-fileinput/css',
            'name' => 'fileinput'
        );
        $this->_plugins_script_admin[] = array(
            'folder' => 'bootstrap-fileinput/js',
            'name' => 'fileinput.min'
        );

        $this->set_plugins_admin();

        $this->_modules_script[] = array(
            'folder' => 'info',
            'name' => 'admin-content-validate'
        );
        $this->set_modules();

        $post = $this->input->post();
        if (!empty($post)) {
            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
            $this->form_validation->set_rules('title', 'Nhập tiêu đề', 'trim|required');

            if ($this->form_validation->run($this)) {
                if ($this->input->post('id')) {
                    $err = FALSE;
                    $id = $this->input->post('id');
                    if (!$this->admin_update($id)) {
                        $err = TRUE;
                    }

                    if ($err === FALSE) {
                        $notify_type = 'success';
                        $notify_content = 'Cập nhật thông tin thành công!';
                        $this->set_notify_admin($notify_type, $notify_content);

                        redirect(get_admin_url($this->_module_slug));
                    } else {
                        $notify_type = 'danger';
                        $notify_content = 'Có lỗi xảy ra!';
                        $this->set_notify_admin($notify_type, $notify_content);
                    }
                } else {
                    $err = FALSE;
                    $insert_id = $this->admin_add();
                    if ($insert_id == 0) {
                        $err = TRUE;
                    }

                    if ($err === FALSE) {
                        $notify_type = 'success';
                        $notify_content = 'Thông tin đã được thêm!';
                        $this->set_notify_admin($notify_type, $notify_content);

                        redirect(get_admin_url($this->_module_slug));
                    } else {
                        $notify_type = 'danger';
                        $notify_content = 'Có lỗi xảy ra!';
                        $this->set_notify_admin($notify_type, $notify_content);
                    }
                }
            }
        }
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
        $title = 'Thêm thông tin - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];

        $segment = 4;
        $id = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
        if ($id != 0) {
            $row = $this->get($id);
            $this->_data['row'] = $row;
            $title = 'Cập nhật thông tin - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];
        }

        $this->_data['title'] = $title;
        $this->_data['main_content'] = 'info/admin/view_page_content';
        $this->load->view('layout/admin/view_layout', $this->_data);
    }

    function admin_content1()
    {
        $post_type = $this->input->post('post_type');
        $attributes = $this->input->post('attributes');

        foreach ($_FILES['attributes']['name']['image'] as $key => $value) {
            if (trim($value) == '') {
                $attributes['image'][$key] = $this->input->post('images')[$key];
            } else {
                $attributes['image'][$key] = $value;
            }
        }

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'link' => $this->input->post('link'),
            'attributes' => serialize($this->parse_attributes($this->input->post('attributes'))),
            'post_type' => $post_type,
            'order' => $this->get_max_order($post_type) + 1,
            'status' => $this->input->post('status') ? 1 : 0,
            'created' => time(),
            'modified' => 0,
            'attributes_1' => $attributes,
            'attributes_image' => $_FILES['attributes']
        );

        $this->_data['data'] = $data;
        $this->load->view('layout/site/partial/view_test', $this->_data);
    }

    function admin_add()
    {
        $post_type = $this->input->post('post_type');

        $attributes = $this->input->post('attributes');
        $attributes_image = $_FILES['attributes'];

        $uploaded_images = [];
        if (!empty($attributes_image['name']['image'])) {
            foreach ($attributes_image['name']['image'] as $key => $image_name) {
                if ($attributes_image['error']['image'][$key] == 0) {
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                    $file_type = $attributes_image['type']['image'][$key];

                    if (in_array($file_type, $allowed_types)) {
                        $new_file_name = $image_name;
                        $destination = $this->_path . $new_file_name;

                        // kiểm tra file, tồn tại thì thêm đuôi
                        $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $file_name_without_ext = pathinfo($image_name, PATHINFO_FILENAME);
                        $counter = 1;
                        while (file_exists($destination)) {
                            $new_file_name = $file_name_without_ext . '_' . $counter . '.' . $file_ext;
                            $destination = $this->_path . $new_file_name;
                            $counter++;
                        }

                        if (move_uploaded_file($attributes_image['tmp_name']['image'][$key], $destination)) {
                            $uploaded_images[$key] = $new_file_name;
                        } else {
                            $uploaded_images[$key] = '';
                        }
                    } else {
                        $uploaded_images[$key] = '';
                    }
                } else {
                    $uploaded_images[$key] = '';
                }
            }
        }

        $parsed_attributes = $this->parse_attributes($attributes);
        foreach ($parsed_attributes as $key => &$attr) {
            $attr['image'] = isset($uploaded_images[$key]) ? $uploaded_images[$key] : '';
        }

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'link' => $this->input->post('link'),
            'attributes' => serialize($parsed_attributes),
            'post_type' => $post_type,
            'order' => $this->get_max_order($post_type) + 1,
            'status' => $this->input->post('status') ? 1 : 0,
            'created' => time(),
            'modified' => 0
        );

        return $this->M_info->add($data);
    }

    function admin_update($id)
    {
        $post_type = $this->input->post('post_type');
        $data_current = $this->get($id);
        $post_type_current = $data_current['post_type'];

        $attributes = $this->input->post('attributes');
        $attributes_image = $_FILES['attributes'];
        $images_old = $this->input->post('images');

        $uploaded_images = [];
        if (!empty($attributes_image['name']['image'])) {
            foreach ($attributes_image['name']['image'] as $key => $image_name) {
                if ($attributes_image['error']['image'][$key] == 0 && !empty($image_name)) { // Có file mới
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                    $file_type = $attributes_image['type']['image'][$key];

                    if (in_array($file_type, $allowed_types)) {
                        $new_file_name = $image_name;
                        $destination = $this->_path . $new_file_name;

                        // kiểm tra file, tồn tại thì thêm đuôi
                        $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $file_name_without_ext = pathinfo($image_name, PATHINFO_FILENAME);
                        $counter = 1;
                        while (file_exists($destination)) {
                            $new_file_name = $file_name_without_ext . '_' . $counter . '.' . $file_ext;
                            $destination = $this->_path . $new_file_name;
                            $counter++;
                        }

                        if (move_uploaded_file($attributes_image['tmp_name']['image'][$key], $destination)) {
                            //xóa file cũ 
                            if (isset($images_old[$key]) && !empty($images_old[$key])) {
                                $old_file_path = $this->_path . $images_old[$key];
                                if (file_exists($old_file_path)) {
                                    unlink($old_file_path);
                                }
                            }
                            $uploaded_images[$key] = $new_file_name;
                        } else {
                            $uploaded_images[$key] = isset($images_old[$key]) ? $images_old[$key] : '';
                        }
                    } else {
                        $uploaded_images[$key] = isset($images_old[$key]) ? $images_old[$key] : '';
                    }
                } else {
                    $uploaded_images[$key] = isset($images_old[$key]) ? $images_old[$key] : '';
                }
            }
        }

        $parsed_attributes = $this->parse_attributes($attributes);
        foreach ($parsed_attributes as $key => &$attr) {
            $attr['image'] = isset($uploaded_images[$key]) ? $uploaded_images[$key] : '';
        }

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'link' => $this->input->post('link'),
            'attributes' => serialize($parsed_attributes),
            'post_type' => $post_type,
            'status' => $this->input->post('status') ? 1 : 0,
            'modified' => time()
        );

        if ($post_type != $post_type_current) {
            $data['order'] = $this->get_max_order($post_type) + 1;
        }

        if ($this->M_info->update($id, $data)) {
            if ($post_type != $post_type_current) {
                $args = $this->default_args();
                $args['post_type'] = $post_type_current;
                $rows_current = $this->M_info->gets($args);

                if (!empty($rows_current)) {
                    $i = 0;
                    foreach ($rows_current as $value) {
                        $i++;
                        $data_order = array(
                            'order' => $i
                        );
                        $this->M_info->update($value['id'], $data_order);
                    }
                }
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function admin_delete()
    {
        $this->_initialize_admin();
        $this->redirect_admin();

        $this->_message_success = 'Đã xóa thông tin!';
        $this->_message_warning = 'Thông tin này không tồn tại!';
        $id = $this->input->get('id');
        if ($id != 0) {
            $row = $this->get($id);
            if ($row) {
                $attributes = unserialize($row['attributes']);
                if (is_array($attributes)) {
                    foreach ($attributes as $attr) {
                        if (isset($attr['image']) && !empty($attr['image'])) {
                            $file_path = $this->_path . $attr['image'];
                            if (file_exists($file_path)) {
                                unlink($file_path);
                            }
                        }
                    }
                }

                if ($this->M_info->delete($id)) {
                    $this->re_order($row['post_type']);
                    $notify_type = 'success';
                    $notify_content = $this->_message_success;
                } else {
                    $notify_type = 'danger';
                    $notify_content = $this->_message_danger;
                }
            } else {
                $notify_type = 'warning';
                $notify_content = $this->_message_warning;
            }
        } else {
            $notify_type = 'warning';
            $notify_content = $this->_message_warning;
        }
        $this->set_notify_admin($notify_type, $notify_content);
        redirect(get_admin_url($this->_module_slug));
    }

    function admin_main()
    {
        $this->_initialize_admin();
        $this->redirect_admin();
        $post = $this->input->post();
        if (!empty($post)) {
            $action = $this->input->post('action');
            if ($action == 'update') {
                $this->_message_success = 'Đã cập nhật thông tin!';
                $this->_message_warning = 'Không có thông tin nào để cập nhật!';
                $ids = $this->input->post('ids');
                $orders = $this->input->post('order');
                $count = count($orders);
                if (!empty($ids) && !empty($orders)) {
                    for ($i = 0; $i < $count; $i++) {
                        $data = array(
                            'order' => $orders[$i]
                        );
                        $id = $ids[$i];
                        if ($this->M_info->update($id, $data)) {
                            $notify_type = 'success';
                            $notify_content = $this->_message_success;
                        } else {
                            $notify_type = 'danger';
                            $notify_content = $this->_message_danger;
                        }
                    }
                } else {
                    $notify_type = 'warning';
                    $notify_content = $this->_message_warning;
                }
                $this->set_notify_admin($notify_type, $notify_content);
                redirect(get_admin_url($this->_module_slug));
            } elseif ($action == 'delete') {
                $this->_message_success = 'Đã xóa các thông tin được chọn!';
                $this->_message_warning = 'Bạn chưa chọn thông tin nào!';
                $ids = $this->input->post('idcheck');

                if (is_array($ids) && !empty($ids)) {
                    foreach ($ids as $id) {
                        $row = $this->get($id);
                        if (!empty($row)) {
                            $attributes = unserialize($row['attributes']);
                            if (is_array($attributes)) {
                                foreach ($attributes as $attr) {
                                    if (isset($attr['image']) && !empty($attr['image'])) {
                                        $file_path = $this->_path . $attr['image'];
                                        if (file_exists($file_path)) {
                                            unlink($file_path);
                                        }
                                    }
                                }
                            }

                            if ($this->M_info->delete($id)) {
                                $this->re_order($row['post_type']);
                                $notify_type = 'success';
                                $notify_content = $this->_message_success;
                            } else {
                                $notify_type = 'danger';
                                $notify_content = $this->_message_danger;
                            }
                        }
                    }
                } else {
                    $notify_type = 'warning';
                    $notify_content = $this->_message_warning;
                }
                $this->set_notify_admin($notify_type, $notify_content);
                redirect(get_admin_url($this->_module_slug));
            } elseif ($action == 'content') {
                redirect(get_admin_url($this->_module_slug . '/content'));
            }
        } else {
            redirect(get_admin_url($this->_module_slug));
        }
    }

    public function parse_attributes($attributes)
    {
        $data = array();
        $bool_label = isset($attributes['label']) && is_array($attributes['label']);
        $bool_content = isset($attributes['content']) && is_array($attributes['content']);
        if ($bool_label && $bool_content) {
            $label = $attributes['label'];
            $content = $attributes['content'];
            $count_label = count($label);
            $count_content = count($content);
            $count = min($count_label, $count_content);
            for ($i = 0; $i < $count; $i++) {
                $data[] = array(
                    'label' => $label[$i],
                    'content' => $content[$i],
                    'image' => isset($attributes['image'][$i]) ? $attributes['image'][$i] : ''
                );
            }
        }
        return $data;
    }

    public function admin_get_attribute_ajax()
    {
        $attribute = $this->input->post('attribute');
        $this->load->view('info/admin/view_attribute', array('attribute' => $attribute));
    }
}   
/* End of file info.php */
/* Location: ./application/modules/info/controllers/info.php */