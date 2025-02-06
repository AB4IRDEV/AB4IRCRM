<x-head>
</x-head>
   
<div class="menu">
    @include('layouts.navbar')
   @include('layouts.sidebar')
    </div>
    <div class="body"  style="margin:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                <x-card-graph></x-card-graph>
                </div>
                <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                    <x-emp-perfomance>

                    </x-emp-perfomance>
                    </div>
                    <div class="col-md-6">
                    <x-Employee-card>

                    </x-Employee-card>
                    </div>
                </div> 
                
                </div>
                <div class="col-md-4">
                <div class="card total">
                    <div class="card-body">
                        <h6>Total Employees</h6>
                        <span>35</span>
                        
                        <div class="row">
    <!-- First Progress Bar -->
    <div class="col">
      <div class="progress">
        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;border-radius:10px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-success" role="progressbar" style="width: 80%;border-radius:10px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;border-radius:10px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    <ul>
        <li>45 Permanent </li>
        <li>23 Contract </li>
        <li>12 Interns</li>
    </ul>
    </div>

                    </div>
                </div>
            </div></div>
            <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <h6>Attendence Overview</h6>
                <span>75%</span>
                <div class="staff">
    <div class="row">
        <div class="col-md-6">
            <div class="leave">
          <div class="legend d-flex gap-2">
            <div class="color-circle" style="background-color: red;height:10px;width:10px; border-radius:50%;margin-top:5px">

            </div>
            <h6>
                Late
            </h6>
          </div>
          <h2>5</h2>
          </div>
        </div>
        <div class="col-md-6">
            <div class="leave">
        <div class="legend d-flex gap-2">
            <div class="color-circle" style="background-color: blue;height:10px;width:10px;margin-top:5px">

            </div>
       
            <h6>
                On time
            </h6>

          </div>
          <h2>5</h2>
          </div>
        </div>
        <h5>34% <i class="bx bx-trending-up"></i> Compared to Last Week</h5>
        
    </div>
</div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <h6>Leave Summary</h6>
                <span>5 leaves left</span>
                <div class="row">
                    <div class="col-md-6">
                        <div class="leave">
                    <h6>Annual Leave</h6>
                    <h4>21</h4>
                    <button class="btn btbn-transparent">Request</button>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="leave">
                    <h6>Sick Leave</h6>  
                    <h4>21</h4>
                    <button class="btn btbn-transparent">Request</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="card"></div>
            </div>
            <div class="col-md-6">
                <div class="card"></div>
            </div>
            </div>
          
            <div class="col-md-12">
            <x-card-table-attendence>
                    
            </x-card-table-attendence>
            </div>
            </div>

    </div>
  

</body>
</html>