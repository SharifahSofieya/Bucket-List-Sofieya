<?php

//get list all
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://onboardme-beta.celcom.com.my/api/bucket-lists');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($curl);

if($e = curl_error($curl)){
    echo $e;
}else{
    $obj = json_decode($resp,true);
    
}
curl_close($curl);
//get list all




//add bucket
if(isset($_POST['submit_post'])){

  foreach($_POST['bucketItems'] as $key=>$item){
     $datalist[] = array('items' => $item);
  }

  $data = [
    'email' => $_POST['email'],
    'bucketItems' => $datalist,
 ];


  $data_string = json_encode($data);
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'http://onboardme-beta.celcom.com.my/api/bucket-lists');
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $resp = curl_exec($curl);
  if($e = curl_error($curl)){
    echo $e;
  }else{
      $objpost = json_decode($resp,true);
  }
  curl_close($curl);
  header("Location: http://localhost/Bucketlist/index2.php"); 
}





  //edit bucket
  if(isset($_POST['submit_edit'])){

    foreach($_POST['bucketitemupd'] as $key=>$item){
      $datalist[] = array('items' => $item);
   }

  $data = [
    'email' => 'sharifah.sofieya@gmail.com',
    'bucketItems' => $datalist,
  ];

    $data_string = json_encode($data);
    

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://onboardme-beta.celcom.com.my/api/bucket-lists/sharifah.sofieya@gmail.com');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    header("Location: http://localhost/Bucketlist/index2.php"); 
}

//delete bucket
if(isset($_POST['submit_delete'])){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://onboardme-beta.celcom.com.my/api/bucket-lists/sharifah.sofieya@gmail.com');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    header("Location: http://localhost/Bucketlist/index2.php"); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>BUCKET PROJECT</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
  body {
      color: #566787;
      background: #f5f5f5;
      font-family: 'Roboto', sans-serif;
  }
  .table-responsive {
      margin: 30px 0;
  }
  .table-wrapper {
      min-width: 1000px;
      background: #fff;
      padding: 20px;
      box-shadow: 0 1px 1px rgba(0,0,0,.05);
  }
  .table-title {
      padding-bottom: 10px;
      margin: 0 0 10px;
      min-width: 100%;
  }
  .table-title h2 {
      margin: 8px 0 0;
      font-size: 22px;
  }
  .search-box {
      position: relative;        
      float: right;
  }
  .search-box input {
      height: 34px;
      border-radius: 20px;
      padding-left: 35px;
      border-color: #ddd;
      box-shadow: none;
  }
  .search-box input:focus {
      border-color: #3FBAE4;
  }
  .search-box i {
      color: #a0a5b1;
      position: absolute;
      font-size: 19px;
      top: 8px;
      left: 10px;
  }
  table.table tr th, table.table tr td {
      border-color: #e9e9e9;
  }
  table.table-striped tbody tr:nth-of-type(odd) {
      background-color: #fcfcfc;
  }
  table.table-striped.table-hover tbody tr:hover {
      background: #f5f5f5;
  }
  table.table th i {
      font-size: 13px;
      margin: 0 5px;
      cursor: pointer;
  }
  table.table td:last-child {
      width: 130px;
  }
  table.table td a {
      color: #a0a5b1;
      display: inline-block;
      margin: 0 5px;
  }
  table.table td a.view {
      color: #03A9F4;
  }
  table.table td a.edit {
      color: #FFC107;
  }
  table.table td a.delete {
      color: #E34724;
  }
  table.table td i {
      font-size: 19px;
  }    
  .pagination {
      float: right;
      margin: 0 0 5px;
  }
  .pagination li a {
      border: none;
      font-size: 95%;
      width: 30px;
      height: 30px;
      color: #999;
      margin: 0 2px;
      line-height: 30px;
      border-radius: 30px !important;
      text-align: center;
      padding: 0;
  }
  .pagination li a:hover {
      color: #666;
  }	
  .pagination li.active a {
      background: #03A9F4;
  }
  .pagination li.active a:hover {        
      background: #0397d6;
  }
  .pagination li.disabled i {
      color: #ccc;
  }
  .pagination li i {
      font-size: 16px;
      padding-top: 6px
  }
  .hint-text {
      float: left;
      margin-top: 6px;
      font-size: 95%;
  }    

</style>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Bucket Lists</h2></div>
                    <div class="col-sm-4">


                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal"></i> Add Bucket</button>
                        

                        <!-- Modal Add-->
                        <form method = "post" action>
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog"  style="width:80%;;" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Bucket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                    <div class="input-group">
                                      <div class="form-group row pt-3">
                                          <div class="col-sm-12">
                                              <label for="role" class="col-form-label">Email</label>
                                              <input  type="text" name="email" class="form-control" >
                                          </div>
                                          <div class="col-sm-12">
                                              <label for="role" class="col-form-label">Bucket Items</label>
                                              <!-- <input  type="text" name="bucketItems" class="form-control" > -->
                                          </div>
                                         
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                                <input type="hidden" name="count" value="1" />
                                                    <div class="control-group" id="fields">
                                                        <div class="controls" id="profs"> 
                                                            <form class="input-append">
                                                            <div id="field"><input autocomplete="off" class="input" id="field1" name="bucketItems[]" type="text"  /><button id="b1" class="btn add-more" type="button">+</button></div>
                                                            </form>
                                                        <!-- <br> -->
                                                        </div>
                                                    </div>
                                          </div>
                                        </div>
                                  </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit_post" value="Submit" class="btn btn-primary btn_add">Save</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </form>
                        <!-- Modal Add-->

                    </div>
                </div>
            </div>

            

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email <i class="fa fa-sort"></i></th>
                        <th>Date Created</th>
                        <th>Bucket List <i class="fa fa-sort"></i></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1?>
                  <?php  foreach($obj as $papar):?> 
                    <tr>
                        <td class ="bucket_id"><?=$no?></td>
                        <td><?=$papar['email'];?></td>
                        <td><?=date("d-m-Y",strtotime($papar['created_at']));?></td>
                        <td>  <?php  foreach($papar["bucketItems"] as $item):?>- <?=$item['items'];?><br><?php endforeach;?></td>
                      
                        <td>
                            <a href="#" class="view view_btn" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="#" class="edit edit_btn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="#" class="delete delete_btn" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                          
                        </td>
                    </tr>
                    <?php $no += 1;?>
                  <?php endforeach;?>
                </tbody>
            </table>


              <!-- Modal edit-->
              <form method = "post" action>
              <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog"  style="width:80%;;" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Bucket</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                      <div class="input-group">
                        <div class="form-group row pt-3">
                            <div class="col-sm-12">
                                <label for="role" class="col-form-label">Email</label>
                                <input id='emailedit' value="" name="emailupd"  class="form-control" >
                            </div>
                            <div class="col-sm-12">
                                <label for="role" class="col-form-label">Bucket Items</label>
                                <input id='bucketitem'  value="" name="bucketitemupd[]"  class="form-control" >
                            </div>
                        </div>

                       
                    </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit"  name="submit_edit" value="Submit"  class="btn btn-primary">Edit</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>
              <!-- Modal edit-->


               <!-- Modal View-->
               <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog"  style="width:80%;;" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">View Bucket</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                      <div class="input-group">
                        <div class="form-group row pt-3">
                            <div class="col-sm-12">
                                <label for="role" class="col-form-label">Email</label>
                                <input  id='emailview' value="" class="form-control" readonly>
                            </div>
                            <div class="col-sm-12">
                                <label for="role"   class="col-form-label">Date</label>
                                <input id='dateview'  value="" class="form-control" readonly>
                            </div>
                            <div class="col-sm-12">
                                <label for="role" class="col-form-label"></label>
                                <table class="table table-striped table-hover table-bordered">
                                      <thead>
                                        <tr>
                                            <th>Bucket List</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='bucketitems'></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal View-->


               <!-- Modal Delete-->
               <form method = "post" action>
                  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog"  style="width:80%;;" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Bucket</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                                  <div class="modal-body">
                                        <h4>Do you want to Delete this data ??</h4>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                                  <button type="submit" name="submit_delete"  class="btn btn-primary" >Yes !! Delete it.</button>
                                </div>
                      </div>
                    </div>
                  </div>
                </form>
              <!-- Modal Delete-->
        </div>
    </div>  
</div>   
</body>
</html>

<script>

  $(document).ready(function () {
      $('.view_btn').on('click',function() {
        
        $('#viewmodal').modal('show');

        $tr=$(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        console.log(data);
        
        $('#emailview').val(data[1]);
        $('#dateview').val(data[2]);
        var bucketitems = $('#bucketitems').text(data[3]);


    });

    $('.edit_btn').on('click',function(event) {
      event.preventDefault();
      $('#editmodal').modal('show');

      $tr=$(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        console.log(data);
        $('#emailedit').val(data[1]);
        $('#bucketitem').val(data[3]);
    });

    $('.delete_btn').on('click',function() {
      $('#deletemodal').modal('show');
    });





    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="bucketItems[]' + next + '" type="text">';
        
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });



  });
</script>