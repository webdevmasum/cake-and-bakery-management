<?php
if(isset($_POST["btnProduction"])){
  $bom=MfgBom::find($_POST["txtId"]);
  $bomdetails=MfgBomDetail::Filter($bom->id);
}else{
  $bom=new MfgBom();
}
?>

<style>
  #cmbCustomer {
    padding: 5px;
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Production</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Create Production</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">



        <!-- Main content -->
        <div class="invoice p-3 mb-3" style="background-color: #D6DBDF">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
            <h4>
              <img src="asset/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle p-2" style="opacity: .8; width:50px; height:50px;"><strong>Cake & Baker</strong>
                <small class="float-right">Date: <?php echo date("d M Y") ?></small>
            </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <table>
                  <tr>
                    <td><label>Code &nbsp;</label></td>
                    <td><input class="form-control" type="text" id="code" name="code" value="<?php echo $bom->code?>" /></td>
                  </tr>
                  <tr>
                    <td><label>BoM Name &nbsp;</label></td>
                    <td><input class="form-control" type="text" id="name" name="name" value="<?php echo $bom->name?>"  /></td>
                  </tr>

                  <tr>
                    <td><label>Mfg Item &nbsp;</label></td>
                    <td>
                        <?php
                          echo Product::html_select_finished_good("cmbFinishedProduct",$bom->product_id);
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <td><label>Build Qty &nbsp;</label></td>
                    <td><input class="form-control" type="text" id="bqty" name="qty" value="0" placeholder="Qty to be built"  /></td>
                  </tr>
                  <!-- <tr>
                    <td><label>Qty &nbsp;</label></td>
                    <td><input class="form-control" type="text" id="qty" name="qty" value="<?php //echo $bom->qty?>"  /></td>
                  </tr> -->
                 
                  <tr>
                    <td><label>Total Labor Cost &nbsp;</label></td>
                    <td>
                      <input class="form-control" type="hidden" id="labor_cost" name="labor_cost" value="<?php echo $bom->labour_cost/$bom->qty?>" />
                      <input class="form-control" type="text" id="total_labor_cost" name="total_labor_cost"  />
                    </td>
                  </tr>
                </table>
              
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              
              
              
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

              <table>
                <tr>
                  <td><b>BoM ID:</b></td>
                  <td><input type="text" style="width:60px" value="<?php echo $bom->id ?>" readonly /></td>
                </tr>
                <tr>
                  <td><b>Date:</b></td>
                  <td><input type="text" id="txtDate" value=<?php echo date("d-m-Y"); ?> /></td>
                </tr>
                
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Raw Materials</th>
					          <th>Unit Cost</th>                   
					          <th>U Qty</th>  
                    <th>Total Cost</th>
                    <th>Total Qty</th>  
                    <th>UoM</th>                    
                    <th>Line Total</th>
                    <th></th>
                  </tr>
                
                </thead>
                <tbody id="items">
                  <?php
                   $subtotal=0;
                   foreach($bomdetails as $d){
                    $line_total=$d->cost*$d->qty;
                    $subtotal+=$line_total;
                    $ucost=$d->cost/$bom->qty;
                    $uqty=$d->qty/$bom->qty;

                     echo "<tr><td></td><td class='pid' data-product_id='$d->product_id'>$d->product</td><td class='u-cost'>$ucost</td><td class='u-qty'>$uqty</td><td class='tcost'>0</td><td class='tqty'>0</td><td class='uid' data-uom_id='$d->uom_id'>$d->uom</td><td class='linetotal'>0</td></tr>";
                   }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-3">
              <strong><?php //echo $bom->remark ?>Remark</strong><br>
              <textarea id="txtRemark" class="form-control"></textarea>
            </div>
            <!-- /.col -->
            <div class="col-4 offset-5">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th style="width:50%;text-align:right">Material Cost:</th>
                      <td style="text-align:right" id="subtotal">0</td>
                    </tr>

                    <tr>
                      <th style="text-align:right">Net Cost:</th>
                      <td style="text-align:right" id="nettotal">0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
             
              <button type="button"  id="btnProcessBuild" class="btn btn-info float-right"><i class="far fa-credit-card"></i> Build Product </button>
              
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
  $(function(){

    $("#btnProcessBuild").on("click",function(){
       
      

      //console.log(materials);

      let data={
        bom_id:2,
        product_id:1,
        uom_id:1,
        date:'2024-04-01',
        labor_cost:3,
        materials:materials
      }

      console.log(data);


    });
        
    $("#bqty").on("input",function(){
         
       let lcost=$("#labor_cost").val();
       let bqty=$(this).val();

       $("#total_labor_cost").val(lcost*bqty);

       UpdateBill();
    });

    var materials=[];
    function UpdateBill(){     
      
       let bqty=$("#bqty").val();

       let subtotal=0;
       materials=[];
       $("#items > tr").each(function(){

          let ucost=$(this).find('.u-cost').text();
          let uqty=$(this).find('.u-qty').text();

          let tcost=ucost*bqty;
          let tqty=uqty*bqty
          let linetotal=tcost*tqty;
          subtotal+=linetotal;

           $(this).find('.tqty').text(tqty);
           $(this).find('.tcost').text(tcost);
           $(this).find('.linetotal').text(linetotal);
           
           let product_id=$(this).find('.pid').data("product_id");
           let uom_id=$(this).find('.uid').data("uom_id");

           materials.push({product_id:product_id,uom_id:uom_id,qty:tqty,cost:tcost});
         
       });

       

       $("#subtotal").text(subtotal);
       let tlaborcost=$("#total_labor_cost").val();

       let nettotal=parseFloat(subtotal)+parseFloat(tlaborcost);
       $("#nettotal").text(nettotal.toFixed(3));
    }
    
  });
</script>