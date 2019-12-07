<?php 

$company = WP_Klantenvertellen_Results::getCompany(1)[0]; 
$reviews = WP_Klantenvertellen_Results::getReviews(1);

?>

<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('Dashboard', 'klantenvertellen'); ?>
    </h1>
    <br/>
    <br/>
    <div id="col-container">

        <div id="col-left">
            
            <h3>Company</h3>
                   
            <table class="wp-list-table widefat fixed striped pages">
                <tbody>
                    <tr>
                        <td><strong>Id</strong></td>
                        <td><?= $company['id'] ?></td>                
                    </tr>
                    <tr>
                        <td><strong>Average Rating</strong></td>
                        <td><?= $company['averagerating'] ?></td>                
                    </tr>    
                    <tr>
                        <td><strong>Number of Reviews</strong></td>
                        <td><?= $company['numberreviews'] ?></td>                
                    </tr>                 
                    <tr>
                        <td><strong>Last 12 Month Average Rating</strong></td>
                        <td><?= $company['last12monthaveragerating'] ?></td>                
                    </tr>
                    <tr>
                        <td><strong>Last 12 Month Number of Reviews</strong></td>
                        <td><?= $company['last12monthnumberreviews'] ?></td>                
                    </tr>    
                    <tr>
                        <td><strong>Percentage Recommendation</strong></td>
                        <td><?= $company['percentagerecommendation'] ?></td>                
                    </tr> 
                    <tr>
                        <td><strong>Location Id</strong></td>
                        <td><?= $company['locationid'] ?></td>                
                    </tr>

                    <tr>
                        <td><strong>Location Name</strong></td>
                        <td><?= $company['locationname'] ?></td>                
                    </tr>
                    <tr>
                        <td><strong>XML Source</strong></td>
                        <td><?= $company['xmlsource'] ?></td>                
                    </tr>    
                    <tr>
                        <td><strong>Added On</strong></td>
                        <td><?= $company['added'] ?></td>                
                    </tr>
                </tbody>
            </table>

      
        </div>
        <div id="col-right"></div>
    </div>
    
</div>