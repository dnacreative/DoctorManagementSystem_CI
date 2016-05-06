
<div class="col-lg-12 pull-left hr" style="margin-bottom: 20px;" >
    <div class="col-lg-4">
        <h2 style="border: 0px;">Procedures</h2>
    </div>
    <div class="col-lg-5">
        <span class="success_msg"> <?=$this->session->flashdata('success_msg')?></span>
    </div>
    <div class="col-lg-3">
        <a href="<?= base_url('admin_dev/procedure/add')?>" class="pull-right btn btn-success add-doctor-btn" >Add Procedure</a>
    </div>
</div>

<div class="col-lg-12 pull-left">
<table id="procedures_table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>              
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Doctors</th>
            <th>Description</th>            
            <th>Action</th>
        </tr>
    </thead>    
        <tbody>                             
        <?php foreach($procedures as $procedure){ ?>
            <tr>
                <td><?=$procedure['name']?></td>
                <td><?=$procedure['type']?></p></td>
                <td><?=$procedure['national_avg']?></td>
                <td><?=$procedure['doctor_count'] ?></td>
                <td><p class='doctor-bio'><?=$procedure['procedure_description']?></p></td>                
                <td>
                    <p>
                        <a href="<?=base_url('admin_dev/procedure/edit/'.$procedure['id'])?>" class="btn btn-info" style="width:70px;" role="button">Edit</a>
                        <a href="<?=base_url('admin_dev/procedure/del/'.$procedure['id'])?>" class="btn btn-danger del" style="width:70px;" role="button">Delete</a>
                    </p>
                </td>
            </tr>
        
        <?php }?>
        
    
    </tbody>

</table>
</div>
