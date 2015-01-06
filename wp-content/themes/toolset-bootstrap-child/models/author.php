<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 14:41
 */

class Author {
    private $userId;

    public function __construct($userId){
        $this->userId = $userId;
    }


    /*
     * Return String
     */
    public function getUserName(){
        return null;
    }


    /*
     * Return Array of Objects
     */
    public function getPhotos(){
        return null;
    }

    /*
     * Return Number
     */
    public function getAverageJudgesRating(){
        return null;
    }

    /*
     * Return Date
     */
    public function getFirstSubmissionDate(){
        return null;
    }

    /*
     * Return Number
     */
    public function getPostCount(){
        return null;
    }


    /*
     * Return Percentage
     */
    public function getConsistency(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalLikesGiven(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalLikesReceived(){
        return null;
    }


    /*
     * Return Number
     */
    public function getAverageLikesReceived(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalCommentsGiven(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalCommentsReceived(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalCommentsRatedHelpful(){
        return null;
    }

    /*
     * Return Array of Objects
     */
    public function getUsersFollowed(){
        return null;
    }


    /*
     * Return Array of Objects
     */
    public function getUsersFollowing(){
        return null;
    }


    /*
     * Return Number
     */
    public function getViewsOfOtherPhotos(){
        return null;
    }


    /*
     * Return Number
     *
     * This should be seconds
     */
    public function getTimeOnSite(){
        return null;
    }


    /*
     * Return Number
     */
    public function getTotalVisits(){
        return null;
    }


    /*
     * Return Array of Strings
     */
    public function getWordPressRoles(){
        return null;
    }


    /*
     * Return Boolean
     */
    public function getHasBlogPosts(){
        return null;
    }


    /*
     * Return Array of post Objects
     */
    public function getBlogPosts(){
        return null;
    }


}