
<div class="col-lg-12 pull-left hr" style="margin-bottom: 20px;" >
    <div class="col-lg-4">
        <h2 style="border: 0px;">IP Block List</h2>
    </div>
    <div class="col-lg-5">
        <span class="success_msg"> <?=$this->session->flashdata('success_msg')?></span>
    </div>
    <div class="col-lg-3">
        <div id="add_blockip_btn" class="pull-right btn btn-success add-doctor-btn" >Add IP</div>
    </div>
</div>

<div class="col-lg-12 pull-left">
<table id="ipblock_table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>              
            <th>No</th>
            <th>IP</th>
            <th>Description</th>            
            <th>Action</th>
        </tr>
    </thead>    
        <tbody>                             
        <?php foreach($ips as $ip){ ?>
            <tr>
                <td><?=$ip['id']?></td>
                <td><?=$ip['ip']?></p></td>
                <td><?=$ip['description']?></td>                
                <td>
                    <p>
                        <span class="btn btn-info edit-blocked-ip" style="width:70px;" role="button" data-id="<?=$ip['id']?>" data-ip="<?=$ip['ip']?>" data-desc="<?=$ip['description']?>" >Edit</span>
                        <span class="btn btn-danger delete-blocked-ip" style="width:70px;" role="button" data-id="<?=$ip['id']?>">Delete</span>
                    </p>
                </td>
            </tr>
        
        <?php }?>
        
    
    </tbody>

</table>  

</div>

<!-- The modal for adding a ip -->
<div class="modal fade" id="add_blockip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo('Close'); ?></span>
                    </button>
                    <?php echo('Add a IP to BlockList'); ?>
                </h3>
            </div>

            <form method="post" id="add_blockip_form" action="">
                <div class="modal-body">
                    <label>IP :</label>
                    <input type="text" class="form-control" placeholder="0.0.0.0" name="block_ip"><br>
                    <label>Description : </label>
                    <textarea placeholder="Description" id="block_description" name="block_description" class="form-control" rows="5"> </textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><?php echo('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The modal for editing a ip -->
<div class="modal fade" id="edit_blockip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo('Close'); ?></span>
                    </button>
                    <?php echo('Edit the IP to BlockList'); ?>
                </h3>
            </div>

            <form method="post" id="edit_blockip_form" action="">
                <div class="modal-body">
                    <div id="edit_blockip_lavel">IP : </div>                     
                    <div>Description : </div>
                    <textarea placeholder="Description" id="edit_block_description" name="block_description" class="form-control" rows="5"> </textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><?php echo('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

