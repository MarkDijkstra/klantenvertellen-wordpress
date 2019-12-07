<?php $reviews = WP_Klantenvertellen_Results::getReviews(1);?>

<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('Reviews', 'klantenvertellen'); ?>
    </h1>
</div>


<div class="wrap">

     <h3>Reviews</h3>

     <table class="wp-list-table widefat fixed striped pages kv--table">
         <thead>
            <tr>             
                <th style="width:60px">Id</th>  
                <th>Reviewer:</th>
                <th>Ervaring</th>
                <th>Beoordelingen</th>
                <th style="width:100px">Aanbevelen</th> 
                <th style="width:60px">Cijfer</th>
            </tr>
         </thead>
         <tbody>
             <?php foreach($reviews as $review){
             
             
                 $contents = WP_Klantenvertellen_Results::getContentByReviewId($review['reviewid']);
    
                 ?>
             
                <tr class="review__block" data-id="<?= $review['id'] ?>" data-reiewid="<?= $review['reviewid'] ?>" 
                    data-updated="<?= date('d-m-Y H:i:s', strtotime($review['updatedsince'])) ?>">
                    <td><?= $review['id'] ?></td>
                    <td>
                        <div class="td__row">
                            <strong>Author: </strong><?= $review['reviewauthor'] ?>
                        </div>
                        <div class="td__row">
                            <strong>Woonplaats: </strong><?= $review['city'] ?>
                        </div>
                        <div class="td__row">
                            <strong>Datum: </strong><?= date('d-m-Y H:i:s', strtotime($review['datesince'])) ?>
                        </div>                        
                    </td> 
                    <td>
                        <?php foreach($contents as $content){
                                                     
                          if($content['questiongroup'] === 'DEFAULT_OPINION'){ ?>
<!--                            <div class="td__row">-->
<!--                                <strong>-->
                                    <?php //echo $content['questiontranslation']; ?>
<!--                                </strong>-->
<!--                            </div>-->
                            <div class="td__row">
                                <?= $content['rating']; ?>
                            </div>
                         <?php }     
                        } 
                        
                        ?>    
    
                    </td>
                    <td>
                        
                         <div class="td__row"> 
                        
                            <?php foreach($contents as $content){

                            $acceptTypes =['CATEGORY', 'CUSTOM'];

                               if(in_array($content['questiongroup'] , $acceptTypes)){ ?>

                                <div class="td__row--2">
                                    <strong><?=$content['questiontranslation']?></strong>
                                    <span><?= $content['rating']; ?></span>
                                </div>

                               <?php }
                            
                               if($content['questiongroup'] === 'DEFAULT_RECOMMEND'){
                            
                                    $reccommend = $content['rating'];
                                }

                             } ?> 
                        </div>

                    </td>
                    <td>
                        <?php 
    
                        if($reccommend == true){
                            echo '<i class="fa fa-check icon--green"></i>';
                        }else{
                            echo '<i class="fa fa-times icon--red"></i>';
                        }
                        ?>
                        
                    </td> 
                    <td>
                        <div class="rating__circle">
                            <?= $review['rating'] ?>
                        </div>
                    </td> 
                </tr>
             <?php } ?>
         </tbody>
    </table>   

</div>