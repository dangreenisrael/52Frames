<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 15:04
 */

class Photo {
    private $photoId;

    public function __construct($photoId){
        $this->photoId = $photoId;
    }


    /*
     * Return String
     */
    public function getUrl(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getIsRated(){
        return null;
    }


    /*
     * Return Number
     */
    public function getRating(){
        return null;
    }


    /*
     * Return Array of Objects
     */
    public function getWhoRated(){
        return null;
    }


    /*
     * Return Number
     */
    public function getRatingCount(){
        return null;
    }


    /*
     * Return Object
     */
    public function getAuthor(){
        return null;
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
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalViews(){
        return null;
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
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasExtraCredit(){
        return null;
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
    public function getHasNudity(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getIsForSale(){
        return null;
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