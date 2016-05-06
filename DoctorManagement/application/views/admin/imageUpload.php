
<div class="col-lg-12 pull-left page-title" >
    <div class="col-lg-6">
        <h2>Edit Doctor Information</h2>
    </div>
    <div class="col-lg-6">
        <span class="success_msg"> <?=$this->session->flashdata('success_msg')?></span>
    </div>
</div>
<form action="<?= base_url('admin_dev/doctor/editprocess/'.$doctor['id'])?>" method="post" enctype="multipart/form-data" id="doctor_create_form">
    <div class="row pull-left">
        <div class="col-lg-6">
            <h4>Personal Information</h4>
            <div class="form-group info-block">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <?= form_error('first_name'); ?>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$doctor['first_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <?= form_error('last_name'); ?>
                    <input type="text" class="form-control" id="last_name" name="last_name"  value="<?=$doctor['last_name']?>" >
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="field">Choose Field</label>
                            <select class="form-control" id="field" name="field" >
                                <option>Plastic Surgery</option>
                                <option>Orthopedic</option>
                                <option>Spine</option>
                                <option>Dental</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="discoverable">Discoverable</label>
                            <select class="form-control" id="discoverable" name="discoverable" >
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="crop-avatar">
                    <div class="col-lg-4 avatar-view" style="float:left;" >
                        <div class="form-group ">
                              <img class='doctor-img' id="doctor_image_src" src="<?=$doctor['img']?>" alt="<?=$doctor['name']?>">
                              <input type="hidden" id="doctor_image_name" name="doctor_image_name">
                        </div>
                    </div>
                    
                    <div class="col-lg-4" style="float:left;">
                        <div class="form-group pull-right">
                            <label for='doctor_image' class="btn btn-primary btn-sm img-labal" id="doctor_image" name="doctor_image" data-toggle="modal" data-target="#avatar-modal"><i class="fa fa-folder-open"></i> Doctor Image</label>
                            <!--<input id="doctor_image" type="file" class="file-loading" name="doctor_image" style="display:none">-->
                            <!--<input id="doctor_image" type="button" class="file-loading" name="doctor_image" data-toggle="modal" data-target="#avatar-modal">-->
                        </div>
                    </div>   
                </div>

                <div class="form-group">
                    <label for="summernote_doctor">Bio</label>
                    <textarea id="summernote_doctor" name="bio" rows="5"><?=$doctor['bio']?></textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h4>Location</h4>
            <div class="form-group info-block">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <?= form_error('address'); ?>
                            <input type="text" class="form-control" id="address"  name="address" value="<?=$doctor['address']?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <?= form_error('zip_code'); ?>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?=$doctor['zip_code']?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_line_two">Address Line Two</label>
                    <?= form_error('address'); ?>
                    <input type="text" class="form-control" id="address_line_two"  name="address_line_two" value="<?=$doctor['address_line_two']?>">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <?= form_error('city'); ?>
                            <input type="text" class="form-control" id="city"  name="city" value="<?=$doctor['city']?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="state">State</label>
                            <?= form_error('state'); ?>
                            <input type="text" class="form-control" id="state" name="state"  value="<?=$doctor['state']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <?= form_error('website'); ?>
                            <input type="text" class="form-control" id="website" name="website" value="<?=$doctor['website']?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <?= form_error('phone'); ?>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=$doctor['phone']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="lon">Longitude</label>
                            <?= form_error('lon'); ?>
                            <input type="text" id='lon' name='lon' class="form-control" value="<?=$doctor['lon']?>">
                        </div>
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="lat">Latitude</label>
                            <?= form_error('lat'); ?>
                            <input type="text" id='lat' name='lat' class="form-control" value="<?=$doctor['lat']?>">
                        </div>
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="angle">Angle</label>
                            <?= form_error('angle'); ?>
                            <input type="text" id='angle' name='angle' class="form-control" value="<?=$doctor['angle']?>">
                        </div>
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="tilt">Tilt</label>
                            <?= form_error('tilt'); ?>
                            <input type="text" id='tilt' name='tilt' class="form-control" value="<?=$doctor['tilt']?>">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                    <div class="form-group">
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="map_lon">Hotel Map Lon</label>
                            <?= form_error('lon'); ?>
                            <input type="text" id='map_lon' name='map_lon' class="form-control" value="<?=$doctor['map_lon']?>">
                        </div>
                        <div class="col-xs-3 col-lg-3 ">
                            <label for="map_lat">Hotel Map Lat</label>
                            <?= form_error('lat'); ?>
                            <input type="text" id='map_lat' name='map_lat' class="form-control" value="<?=$doctor['map_lat']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block row">
        <div class="section col-lg-6">
            <h4 class="section-name">Education</h4>
            <div class="form-group" id="school_block" >
                <?php if(!empty($education )):?>
                    <?php foreach($education as $data){?>
                    <div class="form-group school_element">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="school">School</label>
                                <?= form_error('school'); ?>
                                <input type="text" class="form-control"  name="school[]" value="<?=$data['school']?>">
                                <input type="hidden" name="school_d[]" value="<?=$data['id']?>">
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group pull-right">
                                    <?php if(!empty($data['img']) && file_exists($data['e_path'].'/'.$data['img'])):?>
                                            <img class='doctor-img' src="<?= base_url('public/images/misc/schools').'/'.$data['img']?>" alt="<?=$data['school']?>">
                                    <?php else:?>
                                            <span>No photo</span>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group pull-right">
                                    <label  class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i>Change</label>
                                    <input  type="file" class="file-loading" name="school_image[]" style="display:none">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group pull-right">
                                    <span onclick="add_delete_input($(this),'school','add');" class="add-input school-add-input"><i class="fa fa-plus-circle"></i></span>
                                    <span onclick="deleteInfo($(this),'school',<?=$data['id']?>);" class="delete-input school-delete-input"><i class="fa fa-minus-circle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                <?php else:?>
                    <div class="form-group  school_element">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="school">School</label>
                                <?= form_error('school'); ?>
                                <input type="text" class="form-control"  name="school[]" placeholder="Schools">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group pull-right">
                                    <label  class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i> School Image</label>
                                    <input  type="file" class="file-loading" name="school_image[]" style="display:none">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group pull-right">
                                    <span onclick="add_delete_input($(this),'school','add');" class="add-input school-add-input"><i class="fa fa-plus-circle"></i></span>
                                    <span onclick="add_delete_input($(this),'school','delete');" class="delete-input school-delete-input"><i class="fa fa-minus-circle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>

        <div class="section col-lg-6">
            <h4 class="section-name">Specialties</h4>
            <div class="form-group" id="specialty_block" >
                <span style="color:red;">Add new Specialty</span> <hr/>
                
                <div class="form-group specialty_element">
                    <div class="row">
                        <div class="col-lg-7">
                            <label for="specialty">New Specialty</label>
                            <?= form_error('specialtie'); ?>
                            <select id="new_specialty_dropdown" data-placeholder="Choose a Prcedure..." class="chosen-select" style="width:200px;" tabindex="2">
                                <option value=""></option>    
                                <?php
                                    foreach($procedures as $procedure)
                                    {                                            
                                ?>
                                        <option data-id="<?php echo $procedure['id'];?>" value="<?php echo $procedure['name'];?>"><?php echo $procedure['name']?></option>
                                <?php
                                    }
                                ?>
                            </select>                                                                
                        </div>
                        <div class="col-lg-3">
                            <label for="specialty_price">Price</label>
                            <?= form_error('specialti_price'); ?>
                            <input type="text" class="form-control"  id="new_specialty_price" placeholder="Price">
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group pull-right">
                                <span class="add-input specialty-add-input" id="add_new_specialty_btn"><i class="fa fa-plus-circle"></i></span>
                                <!--<span onclick="add_delete_input($(this),'specialty','delete');" class="delete-input specialty-delete-input"><i class="fa fa-minus-circle"></i></span>-->
                            </div>
                        </div>
                    </div>
                </div> 
                <hr/>
                <div> 
                <span style="color:red;">List of specialties</span> <hr/>           
                    <table id="specialty_table" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th> 
                                <th></th>                       
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach( $specialties as $specialty) {?>
                            <tr>
                                <td>
                                    <?php echo($specialty['name']);?>
                                    <input type="hidden" name="specialty_id[]" value="<?php echo($specialty['id']);?>">
                                    <input type="hidden" name="specialty_real_id[]" value="<?php echo($specialty['real_id']);?>">
                                    <input type="hidden" name="specialty_name[]" value="<?php echo($specialty['name']);?>">
                                </td>
                                <td><input type="text" class="form-control"  name="specialty_price[]" placeholder="0" value="<?php echo($specialty['price']);?>"></td>
                                <td><span class="delete-input specialty-delete-input" style="margin-top: 0;"><i class="fa fa-minus-circle"></i></span></td>
                            </tr>
                            <?php } ?>                            
                        </tbody>
                    </table>
                </div>
                 
            </div>
        </div>
        
    </div>

    <div class="block row">
        <div class="section col-lg-6">
            <h4 class="section-name">Proffesional Activity</h4>
            <div class="form-group info-block">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="license">License</label>
                            <?= form_error('license'); ?>
                            <input type="text" class="form-control" id="license"  name="license" value="<?=$doctor['license']?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="npi">NPI</label>
                            <?= form_error('npi'); ?>
                            <input type="text" class="form-control" id="npi"  name="npi" value="<?=$doctor['npi']?>">
                        </div>
                    </div>
                </div>
                <div class="form-group"  id="certification_block">
                    <?php if(!empty($certifications)):?>
                        <?php foreach($certifications as $data):?>
                        <div class="form-group certification_element">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="certification">Certification</label>
                                    <?= form_error('certification'); ?>
                                    <input type="text" class="form-control"  name="certification[]" value="<?=$data['certification']?>">
                                    <input type="hidden" class="form-control"  name="certification_d[]" value="<?=$data['id']?>">
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group pull-right">
                                        <?php if(!empty($data['img']) && file_exists($data['c_path'].'/'.$data['img'])):?>
                                            <img class='doctor-img' src="<?= base_url('public/images/misc/certifications').'/'.$data['img']?>" alt="<?=$data['certification']?>">
                                        <?php else:?>
                                            <span>No photo</span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group pull-right">
                                        <label class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i>Change</label>
                                        <input type="file" class="file-loading" name="certification_image[]" style="display:none">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group pull-right">
                                        <span onclick="add_delete_input($(this),'certification','add');" class="add-input certification-add-input"><i class="fa fa-plus-circle"></i></span>
                                        <span onclick="deleteInfo($(this),'certification',<?=$data['id']?>)" class="delete-input certification-delete-input"><i class="fa fa-minus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="timeOne" style="width:100%">Time One</label>
                                    <?= form_error('time_one'); ?>
                                    <input type="date" name="time_one[]" class="form-control" value="<?=$data['time_one']?>"/>
                                </div>
                                <div class="col-lg-6">
                                    <label for="timeTwo" style="width:100%">Time Two</label>
                                    <?= form_error('time_two'); ?>
                                    <input  type="date" name="time_two[]" class="form-control" value="<?=$data['time_two']?>"/>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="form-group certification_element">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="certification">Certification</label>
                                    <?= form_error('certification'); ?>
                                    <input type="text" class="form-control"  name="certification[]" placeholder="Certification">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group pull-right">
                                        <label class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i> Certification Image</label>
                                        <input type="file" class="file-loading" name="certification_image[]" style="display:none">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group pull-right">
                                        <span onclick="add_delete_input($(this),'certification','add');" class="add-input certification-add-input"><i class="fa fa-plus-circle"></i></span>
                                        <span onclick="add_delete_input($(this),'certification','delete');" class="delete-input certification-delete-input"><i class="fa fa-minus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="timeOne" style="width:100%">Time One</label>
                                    <?= form_error('time_one'); ?>
                                    <input id="timeOne" type="date" name="time_one[]" class="form-control"/>
                                </div>
                                <div class="col-lg-6">
                                    <label for="timeTwo" style="width:100%">Time Two</label>
                                    <?= form_error('time_two'); ?>
                                    <input id="timeTwo" type="date" name="time_two[]" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
                <div class="form-group"  id="award_block" >
                    <?php if(!empty($awards)):?>
                        <?php foreach($awards as $data):?>
                            <div class="form-group award_element">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="award">Award</label>
                                        <?= form_error('award'); ?>
                                        <input type="text" class="form-control" name="award[]" value="<?=$data['award']?>">
                                        <input type="hidden" class="form-control" name="award_d[]" value="<?=$data['id']?>">
                                    </div>
                                    <div class="col-lg-2 pull-right">
                                        <div class="form-group pull-right">
                                            <span onclick="add_delete_input($(this),'award','add');" class="add-input award-add-input"><i class="fa fa-plus-circle"></i></span>
                                            <span onclick="deleteInfo($(this),'award',<?=$data['id']?>)" class="delete-input award-delete-input"><i class="fa fa-minus-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="given_by">Given By</label>
                                        <?= form_error('given_by'); ?>
                                        <input type="text" class="form-control"  name="given_by[]" value="<?=$data['name']?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="year" style="width:100%">Year</label>
                                        <?= form_error('year'); ?>
                                        <input type="date" name="year[]" class="form-control" value="<?=$data['year']?>" />
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="form-group award_element">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="award">Award</label>
                                    <?= form_error('award'); ?>
                                    <input type="text" class="form-control" name="award[]" placeholder="Award">
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <div class="form-group pull-right">
                                        <span onclick="add_delete_input($(this),'award','add');" class="add-input award-add-input"><i class="fa fa-plus-circle"></i></span>
                                        <span onclick="add_delete_input($(this),'award','delete');" class="delete-input award-delete-input"><i class="fa fa-minus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="given_by">Given By</label>
                                    <?= form_error('given_by'); ?>
                                    <input type="text" class="form-control"  name="given_by[]" placeholder="Given By">
                                </div>
                                <div class="col-lg-6">
                                    <label for="year" style="width:100%">Year</label>
                                    <?= form_error('year'); ?>
                                    <input type="date" name="year[]" class="form-control" />
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
                <div class="form-group"  id="hospital_block">
                    <?php if(!empty($hospital_affiliations)):?>
                        <?php foreach($hospital_affiliations as $data):?>
                            <div class="form-group hospital_element">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="hospital">Hospital</label>
                                        <?= form_error('hospital'); ?>
                                        <input type="text" class="form-control" name="hospital[]" value="<?=$data['hospital']?>">
                                        <input type="hidden" class="form-control" name="hospital_d[]" value="<?=$data['id']?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group pull-right">
                                            <?php if(!empty($data['img']) && file_exists($data['h_path'].'/'.$data['img'])):?>
                                                <img class='doctor-img' src="<?= base_url('public/images/hospitals').'/'.$data['img']?>" alt="<?=$data['hospital']?>">
                                            <?php else:?>
                                                <span>No photo</span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group pull-right">
                                            <label class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i>Change</label>
                                            <input type="file" class="file-loading" name="hospital_image[]" style="display:none">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group pull-right">
                                            <span onclick="add_delete_input($(this),'hospital','add');" class="add-input hospital-add-input"><i class="fa fa-plus-circle"></i></span>
                                            <span onclick="deleteInfo($(this),'hospital',<?=$data['id']?>)" class="delete-input hospital-delete-input"><i class="fa fa-minus-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="hospital_state">Hospital State</label>
                                        <?= form_error('hospital_state'); ?>
                                        <input type="text" class="form-control"  name="hospital_state[]" value="<?=$data['state']?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="hospital_city">Hospital City</label>
                                        <?= form_error('hospital_city'); ?>
                                        <input type="text" class="form-control"  name="hospital_city[]" value="<?=$data['city']?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="form-group hospital_element">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="hospital">Hospital</label>
                                    <?= form_error('hospital'); ?>
                                    <input type="text" class="form-control" name="hospital[]" placeholder="Hospital">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group pull-right">
                                        <label class="btn btn-primary btn-sm img-labal img"><i class="fa fa-folder-open"></i> Hospital Image</label>
                                        <input type="file" class="file-loading" name="hospital_image[]" style="display:none">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group pull-right">
                                        <span onclick="add_delete_input($(this),'hospital','add');" class="add-input hospital-add-input"><i class="fa fa-plus-circle"></i></span>
                                        <span onclick="add_delete_input($(this),'hospital','delete');" class="delete-input hospital-delete-input"><i class="fa fa-minus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="hospital_state">Hospital State</label>
                                    <?= form_error('hospital_state'); ?>
                                    <input type="text" class="form-control"  name="hospital_state[]" placeholder="Hospital State">
                                </div>
                                <div class="col-lg-6">
                                    <label for="hospital_city">Hospital City</label>
                                    <?= form_error('hospital_city'); ?>
                                    <input type="text" class="form-control"  name="hospital_city[]" placeholder="Hospital City">
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>

        <div class="section col-lg-6">
            <h4 class="section-name">Masonry</h4>
            <?php if(!empty($masonry)):?>
                <div class="form-group info-block">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="masonry_title">Masonry Title</label>
                            <input type="text" class="form-control" id="masonry_title"  name="masonry_title" value="<?=$masonry[0]['title']?>">
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group pull-right">
                                <?php if(!empty($masonry[0]['img']) && file_exists($masonry[0]['m_path'].'/'.$masonry[0]['img'])):?>
                                    <img class='doctor-img' src="<?= base_url('public/images/doctors/masonry/').'/'.$masonry[0]['m_folder'].'/'.$masonry[0]['img']?>" alt="<?=$masonry[0]['title']?>">
                                <?php else:?>
                                    <span>No photo</span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group pull-right">
                                <label for='masonry_image' class="btn btn-primary btn-sm img-labal"><i class="fa fa-folder-open"></i>Change</label>
                                <input id="masonry_image" type="file" class="file-loading" name="masonry_image" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="summernote_masonry">Masonry Description</label>
                        <textarea id="summernote_masonry" name="masonry_descriptione" rows="5"><?=$masonry[0]['description']?></textarea>
                    </div>
                </div>
            <?php else:?>
            <div class="form-group info-block">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="masonry_title">Masonry Title</label>
                        <input type="text" class="form-control" id="masonry_title"  name="masonry_title" placeholder="Masonry Title">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group pull-right">
                            <label for='masonry_image' class="btn btn-primary btn-sm img-labal"><i class="fa fa-folder-open"></i> Masonry Image</label>
                            <input id="masonry_image" type="file" class="file-loading" name="masonry_image" style="display:none">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summernote_masonry">Masonry Description</label>
                    <textarea id="summernote_masonry" name="masonry_descriptione" rows="5"></textarea>

                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success pull-right" id="update_doctor">Save Changes</button>
    </div>
</form>

<!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg" style="width: 500px;">
        <div class="modal-content">
          <form class="avatar-form" action="<?php echo base_url('admin_dev/doctor/saveimage')?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="doctor_name" value="<?php echo($doctor['name']) ?>"> 
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Edit Image</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <label for="avatarInput">Local upload</label>
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">                    
                    <div class="avatar-preview preview-md"></div>                    
                  </div>
                </div>

                <div class="row avatar-btns">

                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

<!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>