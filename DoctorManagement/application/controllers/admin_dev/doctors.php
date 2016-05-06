<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
} else {
    class CropAvatar {
        
        private $src;
        private $data;
        private $dst;
        private $dst_url;
        private $type;
        private $extension;
        private $msg;
        private $doctor_name;

        function __construct($src, $data, $file, $doctor_name) {
            
            $this->doctor_name = strtolower(str_replace(' ', '-', $doctor_name));
            $this->setSrc($src);
            $this->setData($data);
            $this->setFile($file);
            $this->crop($this->src, $this->dst, $this->data);
        }

        private function setSrc($src) {
            if (!empty($src)) {
                $type = exif_imagetype($src);

                if ($type) {
                    $this->src = $src;
                    $this->type = $type;
                    $this->extension = image_type_to_extension($type);
                    $this->setDst();
                }
            }
        }

        private function setData($data) {
            if (!empty($data)) {
                $this -> data = json_decode(stripslashes($data));
            }
        }

        private function setFile($file) {
            $errorCode = $file['error'];

            if ($errorCode === UPLOAD_ERR_OK) {
                $type = exif_imagetype($file['tmp_name']);

                if ($type) {
                    $extension = image_type_to_extension($type);
                    //$src = $_SERVER['DOCUMENT_ROOT'] . '/public/images/tmp/' . date('YmdHis') . '.original' . $extension;
                    //$src = $_SERVER['DOCUMENT_ROOT'] . '/public/images/doctors/original/' . $file['name'];// . '_' . date('YmdHis') . '.original' . $extension;
                    $src = $_SERVER['DOCUMENT_ROOT'] . '/public/images/doctors/original/' . $this->doctor_name . ".jpg";// . '_' . date('YmdHis') . '.original' . $extension;
                    //var_dump($src);exit;
                    
                    if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

                        if (file_exists($src)) {
                            unlink($src);
                        }

                        $result = move_uploaded_file($file['tmp_name'], $src);

                        if ($result) {
                            $this -> src = $src;
                            $this -> type = $type;
                            $this -> extension = $extension;
                            $this -> setDst();
                        } else {
                            $this -> msg = 'Failed to save file';
                        }
                    } else {
                        $this -> msg = 'Please upload image with the following types: JPG, PNG, GIF';
                    }
                } else {
                    $this -> msg = 'Please upload image file';
                }
            } else {
                $this -> msg = $this -> codeToMessage($errorCode);
            }
        }

        private function setDst() {
            $this -> dst = $_SERVER['DOCUMENT_ROOT'] . '/public/images/doctors/tmp/' . date('YmdHis') . '.jpg';
            $this -> dst_url = base_url('/public/images/doctors/tmp/' . date('YmdHis') . '.jpg');
            //var_dump($this);exit;
        }

        private function crop($src, $dst, $data) {
            if (!empty($src) && !empty($dst) && !empty($data)) {

                switch ($this -> type) { 
                    case IMAGETYPE_GIF: 
                    $src_img = imagecreatefromgif($src);
                    break;

                    case IMAGETYPE_JPEG: 
                    $src_img = imagecreatefromjpeg($src);
                    break;

                    case IMAGETYPE_PNG:
                    $src_img = imagecreatefrompng($src);
                    break;
                }
 
                if (!$src_img) {
                    $this -> msg = "Failed to read the image file";
                    return;
                }

                $size = getimagesize($src);
                $size_w = $size[0]; // natural width
                $size_h = $size[1]; // natural height

                $src_img_w = $size_w;
                $src_img_h = $size_h;

                $degrees = $data -> rotate;

                // Rotate the source image
                if (is_numeric($degrees) && $degrees != 0) {
                    // PHP's degrees is opposite to CSS's degrees
                    $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

                    imagedestroy($src_img);
                    $src_img = $new_img;

                    $deg = abs($degrees) % 180;
                    $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

                    $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
                    $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

                    // Fix rotated image miss 1px issue when degrees < 0
                    $src_img_w -= 1;
                    $src_img_h -= 1;
                }

                $tmp_img_w = $data -> width;
                $tmp_img_h = $data -> height;                
                $dst_img_w = $data->dst_width;
                $dst_img_h = $data->dst_height;

                $src_x = $data -> x;
                $src_y = $data -> y;

                if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
                    $src_x = $src_w = $dst_x = $dst_w = 0;
                } else if ($src_x <= 0) {
                    $dst_x = -$src_x;
                    $src_x = 0;
                    $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
                } else if ($src_x <= $src_img_w) {
                    $dst_x = 0;
                    $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
                }

                if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
                    $src_y = $src_h = $dst_y = $dst_h = 0;
                } else if ($src_y <= 0) {
                    $dst_y = -$src_y;
                    $src_y = 0;
                    $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
                } else if ($src_y <= $src_img_h) {
                    $dst_y = 0;
                    $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
                }

                // Scale to destination position and size
                $ratio = $tmp_img_w / $dst_img_w;
                $dst_x /= $ratio;
                $dst_y /= $ratio;
                $dst_w /= $ratio;
                $dst_h /= $ratio;

                $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

                // Add transparent background to destination image
                imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
                imagesavealpha($dst_img, true);

                $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

                if ($result) {
                    if (!imagepng($dst_img, $dst)) {
                        $this -> msg = "Failed to save the cropped image file";
                    }
                } else {
                    $this -> msg = "Failed to crop the image file";
                }

                //imagedestroy($src_img);
                //imagedestroy($dst_img);
            }
        }

        private function codeToMessage($code) {
            $errors = array(
                UPLOAD_ERR_INI_SIZE =>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                UPLOAD_ERR_FORM_SIZE =>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                UPLOAD_ERR_PARTIAL =>'The uploaded file was only partially uploaded',
                UPLOAD_ERR_NO_FILE =>'No file was uploaded',
                UPLOAD_ERR_NO_TMP_DIR =>'Missing a temporary folder',
                UPLOAD_ERR_CANT_WRITE =>'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION =>'File upload stopped by extension',
            );

            if (array_key_exists($code, $errors)) {
                return $errors[$code];
            }

            return 'Unknown upload error';
        }

        public function getResult() {
            return !empty($this -> data) ? $this -> dst_url : $this -> src;
        }

        public function getMsg() {
            return $this -> msg;
        }
    }
            
    class Doctors extends CI_Controller
    {

        public function __construct()
        {
            parent:: __construct();
            $this->load->model('admin/doctors_model');
            $this->load->model('admin/procedures_model');
            $this->load->library('image_lib');

            if ($this->session->userdata('admin') != 1)
            {
                redirect('/admin_dev');
            }
        }

        public function index()
        {           
            //$this->load->adminView('admin/doctors_view');
            redirect('/admin_dev/home/', 'refresh');
        }

        // Get all doctors by field
        public function getDoctorsByField($field)
        {
            $this->load->library('pagination');
            
            $per_page = 100;

            $page = (!empty($this->uri->segment(4)) ? $this->uri->segment(4) * $per_page - $per_page : 0);

            $field = str_replace('-', ' ', $field);
            //$total_doctors = $this->doctors_model->getDoctorsByField($field);
            //$doctors = $this->doctors_model->getDoctorsByField($field, $page, $per_page);
            
            $doctors = $this->doctors_model->getDoctorsByField($field);

            $config['base_url'] = base_url("admin_dev/doctors/" . $this->uri->segment(3));
            $config['total_rows'] = count($total_doctors);
            $config['per_page'] = $per_page;
            $config['use_page_numbers'] = TRUE;
            $config['uri_segment'] = 4;
            $config['full_tag_open'] = "<ul class='pagination pull-right'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";

            $this->pagination->initialize($config);

            foreach ($doctors as $key => $doctor)
            {
                $bio = array();
                $doctors[$key]['img'] = $this->createDoctorImg($doctor['name'], 50, 60);
                $doctors[$key]['bio'] = strip_tags(mb_substr($doctor['bio'], 0, 150)). '...';
            }

            $data['doctors'] = $doctors;
            $data['title'] = str_replace("-", " ", $this->uri->segment(3));
            $data["pagination"] = $this->pagination->create_links();
            $data["doctors_param"] = $this->uri->segment(3);

            $this->load->adminView('admin/doctors_view', $data);
        }
        
        // Get doctors list by search
        public function doctorsSearch($field)
        {
            //var_dump($_REQUEST);exit;              
            
            $result = array();
            
            $result['draw'] = $_REQUEST["draw"]++;
            
            $field = str_replace('-', ' ', $field);            
            $total_count = $this->doctors_model->getNumDoctorsByField($field);                    
            $doctors = $this->doctors_model->getDoctorsByField($field);
            
            $result['recordsTotal'] = $total_count;
            $result['recordsFiltered'] = count($doctors);
            
            $data = array();
            
            foreach($doctors as $doctor)
            {                   
                $tmp = array();
                
                $image = base_url('public/images/doctors/' . strtolower($doctor['first_name'] . '_' . strtolower($doctor['last_name']) . ".jpg"));
                array_push($tmp, '<img class="doctor-img" src="' . $image . '" alt="' . $doctor['name'] . '">');                
                array_push($tmp, $doctor['name']);
                array_push($tmp, "<p class='doctor-bio'>" . substr(strip_tags($doctor['bio']), 0, 155) . "...</p>");
                array_push($tmp, $doctor['address']);
                $action =   '<a href="' . base_url("admin_dev/doctor/edit/" . $doctor['id']) . '" class="btn btn-info" role="button">Edit</a>' . 
                            '<a href="' . base_url("admin_dev/doctor/del/" . $doctor['id']) . '" class="btn btn-danger del" role="button">Delete</a>';
                array_push($tmp, $action);
                array_push($data, $tmp);
            }
            
                        
            $result['data'] = $data;

            echo json_encode($result);   
            
        }


        public function createDoctorImg($name)
        {
            $name = strtolower(str_replace(' ', '-', $name));
            $imagePath = 'public/images/doctors/' . $name . '.jpg';
            //var_dump($_SERVER['DOCUMENT_ROOT'] . $imagePath);exit;
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath))
            {
                return base_url($imagePath);
            }
            else
            {
                return base_url('public/images/default.svg');;
            }
        }

        // Add new doctor
        public function add()
        {               
            $this->load->adminView('admin/addNewDoctor_view');
        }

        // addProcess
        public function addProcess()
        {                
            $data = $this->input->post();
            
            //$validationFlag = $this->validation($data, $_FILES);
            $validationFlag = true;
            if ($validationFlag)
            {
                $files = array();
   
                $doctors = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'field' => $this->input->post('field'),
                    'name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),                    
                    'discoverable' => $this->input->post('discoverable')
                );

                $doctor_id = $this->doctors_model->addNewDoctor('doctors', $doctors);
                $post = $this->input->post();
                
                $this->session->set_flashdata('success_msg', 'New doctor successfully added');
                redirect('/admin_dev/doctor/edit/' . $doctor_id);
            }
        }

        /**
         * @param $name
         */


        public function currect_array($postName,$tableName,$post,$doctor_id = '',$images='')
        {               
            $data = array();
            $count = count($post[$postName[0]]);
            for($i = 0; $i < $count; $i++)
            {
                for($j = 0; $j < count($postName); $j++)
                {
                    $data[$i][$tableName[$j]] = $post[$postName[$j]][$i];
                    if($doctor_id !='')
                    {
                        $data[$i]['doctor_id'] = $doctor_id;
                    }
                    if($images !='')
                    {
                        $data[$i]['img'] = $images[$i];
                    }

                }
            }
            return $data;
        }

        public function createImgArray($data)
        {                    
            for($i=0;$i<count($data['name']);$i++)
            {     
                $newData[$i]['name'] = $data['name'][$i];
                $newData[$i]['type'] = $data['type'][$i];
                $newData[$i]['tmp_name'] = $data['tmp_name'][$i];
                $newData[$i]['error'] = $data['error'][$i];
                $newData[$i]['size'] = $data['size'][$i];
            }
            return $newData;
        }

        /**
         * @param $data
         * @param $files
         * @param string $action
         * @param $doctors_id
         * @return bool
         */

        public function validation($data, $files, $action = 'add', $doctors_id = '')
        {         
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
            $rules = array(
                array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'required|min_length[2]'
                ),
                array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'required|min_length[2]'
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'city',
                    'label' => 'City',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'zip_code',
                    'label' => 'Zip Code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'lon',
                    'label' => 'Lon',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'lat',
                    'label' => 'lat',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'angle',
                    'label' => 'Angle',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'tilt',
                    'label' => 'Tilt',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'school',
                    'label' => 'School',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'specialty',
                    'label' => 'Specialty',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'specialty_price',
                    'label' => 'Specialty Price',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'certification',
                    'label' => 'Certification',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'given_by',
                    'label' => 'Given By',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'hospital',
                    'label' => 'Hospital',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'hospital_state',
                    'label' => 'Hospital State',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'hospital_city',
                    'label' => 'Hospital City',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE)
            {
                if ($action == 'edit')
                {
                    $doctor = $this->doctors_model->getDoctorAllInformation($doctors_id);
                    $doctor['img'] = $this->createDoctorImg($doctor['name']);
                    $doctor['e_path'] = './public/images/misc/schools';
                    $doctor['c_path'] = './public/images/misc/certifications';
                    $doctor['h_path'] = './public/images/hospitals';
                    $doctor['m_path'] = './public/images/doctors/masonry/' . strtolower(str_replace(' ', '_', $doctor['name']));
                    $doctor['m_folder'] = strtolower(str_replace(' ', '_', $doctor['name']));
                    $data['doctor'] = $doctor;
                    $this->load->adminView('admin/editDoctorInfo_view', $data);
                }
                else
                {
                    $this->load->adminView('admin/addNewDoctor_view');
                }
            }
            else
            {
                return TRUE;
            }
        }

        //uploade image
        public function do_upload($data,$path,$name = '')
        {             
            if($data['error'] == 0)
            {
                $type = '.'.substr($data['type'],6);
                $name = ($name == '')? md5(time()):$name;     
                $tmp = $data['tmp_name'];
                //$destination = $path.'/'.$name.$type;     
                $destination = $path.'/'.$name.'.jpg';     
                if (!file_exists($path))
                {
                    mkdir($path, 0777, TRUE);
                }     
                //var_dump($data, $tmp, $destination, $name);exit;                                    
                move_uploaded_file($tmp,$destination);
                return $name.'.jpg';
            }
            else
            {
                return FALSE;
            }

        }

        public function edit($id)
        {      
            $doctor = $this->doctors_model->getDoctorAllInformation('doctors',$id);
            
            $awards = $this->doctors_model->getDoctorAllInformation('awards',$id);
            $certifications = $this->doctors_model->getDoctorAllInformation('certifications',$id);
            $education = $this->doctors_model->getDoctorAllInformation('education',$id);
            $hospital_affiliations = $this->doctors_model->getDoctorAllInformation('hospital_affiliations',$id);
            $masonry = $this->doctors_model->getDoctorAllInformation('masonry',$id);
            $specialties = $this->doctors_model->getDoctorAllInformation('new_specialties',$id);
            $procedures = $this->procedures_model->getAllProceduresIdName();

            //var_dump($specialties);exit;
            $doctor['img'] = $this->createDoctorImg($doctor['name']);
            //var_dump($doctor);exit;
            foreach($certifications as $key => $data)
            {
                $certifications[$key]['c_path'] = './public/images/misc/certifications';
            }  

            foreach($education as $key => $data)
            {
                $education[$key]['e_path'] = './public/images/misc/schools';
            }

            foreach($hospital_affiliations as $key => $data)
            {
                $hospital_affiliations[$key]['h_path'] = './public/images/hospitals';
            }

            foreach($masonry as $key => $data)
            {
                $masonry[$key]['m_path'] = './public/images/doctors/masonry/' . strtolower(str_replace(' ', '_', $doctor['name']));
                $masonry[$key]['m_folder'] = strtolower(str_replace(' ', '_', $doctor['name']));
            }
               
            $allData = array(
                'doctor' => $doctor,
                'awards' => $awards,
                'certifications' => $certifications,
                'education' => $education,
                'hospital_affiliations' => $hospital_affiliations,
                'masonry' => $masonry,
                'specialties' => $specialties,
                'procedures' => $procedures
            );

            $this->load->adminView('admin/editDoctorInfo_view', $allData);
        }


        /**
         * Update doctor's info
         *
         * @param $doctors_id
         */

        public function editProcess($doctors_id)
        {     
            //var_dump($_REQUEST);exit;  
            $data = $this->input->post();
            //var_dump($data. $_FILES['street_image']);exit;
            
            //check is_street_iamge
            $is_street_image = $data['is_street_image'];
            
            //check is_simpleview
            $is_full_profile = $data['is_full_profile'];
            
            $is_bme = $data['is_bme'];
            
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            
            
            if($is_street_image == 'on')
            {
                $is_street_image = 1;   
            }
            else
            {
                $is_street_image = 0;
            }
            
            if($is_bme == 'on')
            {
                $is_bme = 1;   
            }
            else
            {
                $is_bme = 0;
            }
            
            
            if($is_full_profile == 'on') 
                $is_full_profile = 1;   
            else  
                $is_full_profile = 0;  
                
                       
            //var_dump($is_street_image);exit;
            
            $masonry_image = '';
            //$validationFlag = $this->validation($data, $_FILES);
            $validationFlag = true;
            if ($validationFlag)
            {
                
                $files = array();
                foreach($_FILES as $inputName => $data)
                {
                    if(($inputName !== 'street_image')&&($inputName !== 'doctor_image') && ($inputName !== 'masonry_image') && ($inputName !== 'files'))
                    {   
                        $files[$inputName] = $this->createImgArray($data);                        
                    }
                    else
                    {
                        switch ($inputName)
                        {                              
                            case 'masonry_image':    
                                
                                $data1 = explode('.', $data['name']);
                                $image_index = 0;
                                
                                $masonry_name = strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')) . '_' . $data1[0] . '_voyagermed_' . $image_index ;
                                $k1 = ('public/images/doctors/masonry/' . strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')) . '/' . $masonry_name . '.' . $data1[1]);
                                $k = file_exists($k1);
                                
                                while(file_exists('public/images/doctors/masonry/' . strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')) . '/' . $masonry_name  . '.' . $data1[1]))
                                {
                                    $image_index++;
                                    $masonry_name = strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')) . '_' . $data1[0] . '_voyagermed_' . $image_index;
                                }
                                
                                $masonry_image = $this->do_upload($data,'public/images/doctors/masonry/' . strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')), $masonry_name);                                
                                
                                continue;
                            case 'street_image':   
                                $this->do_upload($data,'public/images/doctors/location', $first_name . '_' . $last_name);
                                //var_dump($street_images);exit;
                                continue;
                        }
                    }
                }              
                foreach ($files as $inputName => $inputdata)
                {   
                    foreach($inputdata as $data)
                    {
                        switch ($inputName)
                        {
                            case 'hospital_image':
                                $hospital_image[] = $this->do_upload($data,'public/images/hospitals');
                                continue;
                            case 'certification_image':
                                $certification_image[] = $this->do_upload($data,'public/images/misc/certifications');
                                continue;
                            case 'school_image':
                                $school_image[] = $this->do_upload($data,'public/images/misc/schools');
                                continue;                            
                        }
                    }
                }
                
                //save doctor image

                //$doctor_image = $this->do_upload($data, 'public/images/doctors', strtolower($this->input->post('first_name') . '_' . $this->input->post('last_name')));
                $doctor_image_name = $this->input->post('doctor_image_name');
                $tmp_image = $_SERVER['DOCUMENT_ROOT'] . '/public/images/doctors/tmp/' . $doctor_image_name;
                $dst_image = $_SERVER['DOCUMENT_ROOT'] . '/public/images/doctors/' . strtolower($this->input->post('first_name') . '-' . $this->input->post('last_name') . '.jpg');
                $a = rename($tmp_image, $dst_image);
                //var_dump($tmp_image, $dst_image, $a);exit;
                
                $doctors = array(
                    'is_full_profile' => $is_full_profile,
                    'is_bme' => $is_bme,
                    'is_street_image' => $is_street_image,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'field' => $this->input->post('field'),
                    'name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    'title' => $this->input->post('title'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zip_code' => $this->input->post('zip_code'),
                    'phone' => $this->input->post('phone'),
                    'lon' => $this->input->post('lon'),
                    'lat' => $this->input->post('lat'),
                    'angle' => $this->input->post('angle'),
                    'tilt' => $this->input->post('tilt'),
                    'bio' => $this->input->post('bio'),
                    'website' => $this->input->post('website'),
                    'map_lon' => $this->input->post('map_lon'),
                    'map_lat' => $this->input->post('map_lat'),
                    'dox_field' => $this->input->post('dox_field'),
                    'license' => $this->input->post('license'),
                    'discoverable' => $this->input->post('discoverable'),
                    'address_line_two' => $this->input->post('address_line_two'),
                    'npi' => $this->input->post('npi'),                    
                );
                
                //var_dump($doctors);exit;
                if($masonry_image != '')
                {          
                    $doctors['masonry'] = 1;  
                }
                
                $post = $this->input->post();
                                
                $spe = $this->currect_array(array('specialty_id', 'specialty_name','specialty_real_id','specialty_price','specialty_name', 'specialty_real_id'),array('id', 'name','name_id','price', 'procedure_name', 'real_id'),$post,'','');
                //var_dump($spe);exit;
                
                $allData = array(
                        'doctors' => $doctors,
                        'awards' => $this->currect_array(array('award','given_by','year','award_d'),array('award','name','year','id'),$post),
                        'certifications' => $this->currect_array(array('certification','time_one','time_two','certification_d'),array('certification','time_one','time_two','id'),$post,'',$certification_image),
                        'education' => $this->currect_array(array('school','school_d'),array('school','id'),$post,'',$school_image),
                        'hospital_affiliations' => $this->currect_array(array('hospital','hospital_city','hospital_state','hospital_d'),array('hospital','city','state','id'),$post,'',$hospital_image),
                        'new_specialties' => $this->currect_array(array('specialty_id', 'specialty_name','specialty_real_id','specialty_price','specialty_name', 'specialty_real_id'),array('id', 'name','name_id','price', 'procedure_name', 'real_id'),$post,'',''),                        
                        
                    );
                    
                if($masonry_image)
                {
                    $masonry_data = array(
                            'img' => $masonry_image,
                            'title' => $this->input->post('masonry_title'),
                            'description' => $this->input->post('masonry_descriptione'),
                        );
                    $allData['masonry'] = $masonry_data;                                           
                }
                
                
                //var_dump($allData, "---------------");

                foreach ($allData as $table => $tableData)
                {      
                    //delete records that are not in id array
                    if($table == "new_specialties")
                    {//var_dump($table, "=====>", $data, $doctors_id);
                        $this->doctors_model->deleteDoctorInfo_Without_Id_InArray($table, $tableData, $doctors_id);    
                    }
                    
                
                    if($table != 'masonry' && $table != 'doctors')
                    {
                        foreach($tableData as $data )
                        {
                            foreach ($data as $key => $value)
                            {
                                if (empty(trim($value)))
                                {
                                    if($value == null){}
                                    else{
                                        unset($data[$key]);
                                    }
                                }
                            }
                            if($table == "new_specialties"){
                                //var_dump($table, "=====>", $data, $doctors_id);    
                            }
                            //var_dump($table, "1");

                            $this->doctors_model->editDoctorInfo($table, $data,$doctors_id);
                        }
                    }
                    else
                    {     
                        foreach ($tableData as $key => $value)
                        {        
                            if (empty(trim($value)))
                            {
                                if(($key != 'is_street_image')&&($key != 'is_full_profile'))
                                    unset($tableData[$key]);                                
                            }
                        } 
                                   
                      
                        $this->doctors_model->editDoctorInfo($table, $tableData,$doctors_id);
                    }     
                } 
                             
                $this->session->set_flashdata('success_msg', 'Doctor successfully edited');
                redirect('/admin_dev/doctor/edit/' . $doctors_id);
            }
        }

        public function deleteDoctorById($id)
        {                        
            $this->doctors_model->deleteDoctorById($id);
            redirect('/admin_dev/home');
        }

        public function searchProcedures()
        {            
            $searchItem = $this->input->post("term");
            $result = $this->doctors_model->searchProcedures($searchItem);
            echo json_encode($result);
            die;

        }

        public function deleteInfo()
        {           
            $key = $this->input->post('name');
            $id = $this->input->post('id');

            $tables = array(
                'school' => 'education',
                'specialty' => 'new_specialties',
                'certification' => 'certifications',
                'award' => 'awards',
                'hospital' => 'hospital_affiliations',
            );

            $result = $this->doctors_model->deleteInfo($tables[$key],$id);
            echo json_encode($result);
        }
        
        
        //====================================== image crop ===============
        
        public function saveImage()
        {               
            $crop = new CropAvatar(
              isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
              isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
              isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null,
              $_REQUEST['doctor_name']
            );

            $response = array(
              'state'  => 200,
              'message' => $crop -> getMsg(),
              'result' => $crop -> getResult()
            );

            echo json_encode($response);
        }
        //=================================================================
        
        
        
    }
}
