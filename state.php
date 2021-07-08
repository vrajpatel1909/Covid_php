
<html>
    <head>
        <title>Covid-19</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
        
    </head>
    <body>
        <h1>COVID-INFO</h1>
        <marquee behaviour="scroll" direction="left" style="color:red;font-size:30px">
            <?php
                $data = file_get_contents('https://api.covid19india.org/data.json');
                $coronalive = json_decode($data,true);
                $statecount = count($coronalive['statewise']);

                $totalconfirmed = $coronalive['statewise'][0]['confirmed'];
                $totalactive = $coronalive['statewise'][0]['active'];
                $totalrecovered = $coronalive['statewise'][0]['recovered'];
                $totaldeaths = $coronalive['statewise'][0]['deaths'];
                $dailyincreased = $coronalive['statewise'][0]['deltaconfirmed'];
                $dailyrecovered = $coronalive['statewise'][0]['deltarecovered'];
                $dailydeaths = $coronalive['statewise'][0]['deltadeaths'];
                echo "Total_Cases-",$totalconfirmed, ", Active_cases-" ,$totalactive, ", Recovered-" ,$totalrecovered, ", Total_deaths-",$totaldeaths,", Today's_cases-",$dailyincreased,", Today's_recovered_cases-",$dailyrecovered,", Today's_deaths-",$dailydeaths;
            ?> 

        </marquee>




        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>State/UT</th>
                        <th>Confirmed</th>
                        <th>Active</th>
                        <th>Recovered</th>
                        <th>Deaths</th>
                        
                    </tr>
                </thead>
                <?php
                        
                        
                        $i = 1;

                        while($i < $statecount){
                            $dayconfirm = $coronalive['statewise'][$i]['deltaconfirmed'];
                            $dayrecovered = $coronalive['statewise'][$i]['deltarecovered'];
                            $daydeaths = $coronalive['statewise'][$i]['deltadeaths'];
                            $statename = $coronalive['statewise'][$i]['state'];
                            
                            
                        

                ?>
                    <tr>
                    <td>  <?php echo $statename; ?>  </td>
                    <td>  <?php echo $coronalive['statewise'][$i]['confirmed'];
                                if($dayconfirm!=0){
                                    echo "+";
                                    echo $dayconfirm;}?>  </td>
                    <td>  <?php echo $coronalive['statewise'][$i]['active']; ?>  </td>
                    <td>  <?php echo $coronalive['statewise'][$i]['recovered']; 
                                if($dayrecovered!=0){
                                    echo "+";
                                    echo $dayrecovered;}?>  </td>
                    <td>  <?php echo $coronalive['statewise'][$i]['deaths'];
                                if($daydeaths!=0){
                                    echo "+";
                                    echo $daydeaths;} ?>  </td>
                    </tr>
                <?php
                    $i++;
                    }
                ?>

            
            </table>
        </div>
    </body>
</html>