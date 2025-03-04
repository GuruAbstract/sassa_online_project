
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Accounts Summary</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if($userall!=null)
              <table class="table table-responsive table-striped">

                  <tr>

                      <th>Create At</th>
                      <th>Updated At</th>
                      <th>Account Number</th>
                      <th>Balance</th>

                  </tr>

         <?php $sum=0.00; ?>

                  @foreach($userall as $detail)
                      <?php $sum=$sum+$detail->balance;?>
                      <tr>

                          <td>{{$detail->created_at}}</td>
                      <td>{{$detail->updated_at}}</td>

                      <td>{{$detail->accountno}}</td>
                      <td>R{{$detail->balance}}</td>


                      </tr>


                  @endforeach

                  <tr class="alert alert-info">
                      <td></td>
                      <td></td>
                      <td>Total Amount In All Accounts</td>
                      <td>
                          <strong>
                          R<?php echo $sum; ?>
                          </strong>
                      </td>

                  </tr>
              </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

