<div class="container" style="margin-top: px">
  <div class="row">
      <div class="col-md-12">
          <h2>account edit</h2>
              
              @if (Session::has('success'))
              <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
              @endif
              @if (session::has('fail'))
              <div class="alert alert-danger">{{Session::get('fail')}}</div>
              @endif

              <form action="{{url('customer/update')}}" method="POST">
              @csrf
              
              <div class="md-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="customerUsername" placeholder="enter username">
                  <span class="text-danger">@error('customerUsername'){{$message}}@enderror</span>
              </div>

              <div class="md-3">
                  <label class="form-label">Password</label>
                  <input type="text" class="form-control" name="customerPassword" placeholder="enter password">
                  <span class="text-danger">@error('customerPassword'){{$message}}@enderror</span>
              </div>

              <div class="md-3">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" name="customerMail" placeholder="enter email">
                  <span class="text-danger">@error('customerMail'){{$message}}@enderror</span>
              </div>

              <button type="submit" class="btn button-primary">update</button>

              <a href="{{url('customer/info')}}" class="btn btn-danger">Back</a>

          </form>
      </div>
  </div>
</div>