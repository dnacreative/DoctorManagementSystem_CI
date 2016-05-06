<div class="col-lg-12 pull-left page-title" >
    <div class="col-lg-6">
        <h2>Add New Doctor</h2>
    </div>
    <div class="col-lg-6">
        <span class="success_msg"> <?=$this->session->flashdata('success_msg')?></span>
    </div>
</div>
    <form action="<?=base_url('admin_dev/doctor/addprocess')?>" method="post" enctype="multipart/form-data" id="doctor_create_form">
        <div class="block row">
            <div class="section col-lg-6">
                <h4 class="section-name">Personal Information</h4>
                <div class="form-group info-block">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <?= form_error('first_name'); ?>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <?= form_error('last_name'); ?>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
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
                            <div class="form-group ">
                                <label for="discoverable">Discoverable</label>
                                <select class="form-control " id="discoverable" name="discoverable" >
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
