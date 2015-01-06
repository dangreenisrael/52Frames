<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 15:04
 */

class Photo {
    private $postId;
    private $postObject;
    private $judgeRatingText;
    private $photoMeta;

    public function __construct($postId){
        $this->postId = $postId;
        $this->postObject = get_post($postId);
        $this->judgeRatingText = strip_tags(the_ratings_results($this->postId));
        $this->photoMeta = get_post_meta( $this->postId);
    }


    /*
     * Return String
     */
    public function getUrl(){
        return wp_get_attachment_url( get_post_thumbnail_id($this->postId) );
    }


    /*
     * Return Boolean
     */
    public function getIsJudgeRated(){
        $rating = intval($this->photoMeta['ratings_users'][0]);
        if ($rating == 0){
            return false;
        } else{
            return true;
        }
    }

    /*
     * Return Number
     */
    public function getJudgeRatingCount(){
        $rating = $this->photoMeta['ratings_users'][0];
        return intval($rating);
    }


    /*
     * Return Number
     */
    public function getJudgeRating(){
        $rating = $this->photoMeta['ratings_average'][0];
        return floatval($rating);
    }


    /*
     *
     * Return Array of Objects
     */
    public function getWhoRated(){
        return null;
    }


    /*
     * Return Object
     */
    public function getAuthor(){
        $authorID = $this->postObject->post_author;
        return new Author($authorID);
    }


    /*
     * Return Object
     */
    public function getAlbum(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalLikes(){
        return intval(GetWtiLikeCount($this->postId));
    }


    /*
     * Return Number
     */
    public function getTotalViews(){
        return intval(getPostViews($this->postId));
    }


    /*
     * Return Number
     */
    public function getTotalComments(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasAward(){
        return null;
    }


    /*
     * Return Number
     */
    public function getAward(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasAudienceAward(){
        return null;
    }


    /*
     * Return Number
     *
     * i.e. Author's 23rd submission
     *
     */
    public function getSubmissionNumber(){
        return null;
    }

    /*
     * Return Number
     */
    public function getWeek(){
        return null;
    }


    /*
     * Return Number
     */
    public function getYear(){
        $date=date_create($this->postObject->post_date);
        return date_format($date,"Y");
    }


    /*
     * Return Boolean
     */
    public function getHasExtraCredit(){
        return get_post_custom_values('wpcf-extra-challange', $this->postId)[0];
    }


    /*
     * Return String
     */
    public function getExtraCredit(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasNudity1(){
        return get_post_custom_values('wpcf-theres-nudity', $this->postId)[0];
    }

    /*
     * Return Boolean
     */
    public function getHasNudity2(){
        return get_post_custom_values('wpcf-has-nudity', $this->postId)[0];
    }


    /*
     * Return Boolean
     */
    public function getIsForSale(){
        return get_post_custom_values('wpcf-for-sale', $this->postId)[0];
    }


    /*
     * Return Number
     */
    public function getTotalFacebookShares(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalGooglePlusShares(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalLinkedInShares(){
        return null;
    }


    /*
     * Return Date
     */
    public function getSubmissionDateTime(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasModeratorCritique(){
        return null;
    }

}