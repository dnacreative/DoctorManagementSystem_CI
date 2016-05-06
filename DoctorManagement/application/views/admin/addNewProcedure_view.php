
<div class="col-lg-12 pull-left page-title" >
    <div class="col-lg-6">
        <h2>Add New Procedure</h2>
    </div>
    <div class="col-lg-6">
       <span class="success_msg"> <?=$this->session->flashdata('success_msg')?></span>
    </div>
</div>

<form action="<?=base_url('admin_dev/procedure/addprocess')?>" method="post" enctype="multipart/form-data" id="doctor_create_form">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <div class="form-group">
                    <label for="procedure_name">Procedure Name</label>
                    <?= form_error('procedure_name'); ?>
                    <input type="text" name="procedure_name" class="form-control" id="procedure_name" placeholder="Procedure Name">
                </div>
                <div class="form-group">
                    <label for="procedure_type">Procedure type</label>
                    <?= form_error('procedure_type'); ?>
                    <input type="text" class="form-control" id="procedure_type" name="procedure_type" placeholder="Procedure type">
                </div>
                <div class="form-group">
                    <label for="national_avg">Average procedure cost in the U.S.</label>
                    <?= form_error('procedure_type'); ?>
                    <input type="text" class="form-control" id="national_avg" name="national_avg" placeholder="National AVG">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="summernote_procedure">Procedure Description</label>
                <textarea id="summernote_procedure" name="procedure_description_full"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success pull-right">Submit</button>
    </div>
</form>