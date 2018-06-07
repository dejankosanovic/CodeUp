<?php

require_once("../codeup_res/models/user_suggestions_pool.php");
require_once("../codeup_res/controllers/controller.php");

/**
 * UserController class is used to render pages for user of the platform
 */
class UserController extends Controller {

    public function header_navigation() {
        return array(
            'Home' => './',
            'MyProfile' => 'profile',
            'Explore' => 'explore',
            'Search' => 'search',
            'Logout' => 'logout'
        );
    }





    private function all_support_fields_are_set() {
        return isset($_POST['selection']) && isset($_POST['form-title']) && isset($_POST['form-textarea']);
    }

    private function all_support_fields_are_filled() {
        return !empty($_POST['selection']) && !empty($_POST['form-title']) && !empty($_POST['form-textarea']);
    }

    public function support() {
        $error_message = "";
        if(!$this->all_support_fields_are_set()) {
            require_once("../codeup_res/views/support.php");
        }
        else if(!$this->all_support_fields_are_filled()) {
            $error_message = "Please fill in the form.";
            require_once("../codeup_res/views/support.php");
        }
        else {
            $title = $_POST['form-title'];
            $form_content = $_POST['form-textarea'];
            $selection = $_POST['selection'];
            //$POST['selection'] determines if user sent bug report or feature request
            $sent_by_user = $_SESSION['username'];
            if($selection == "report-problem") {
                UserSuggestionsPool::add_bug_report($title, $form_content, $sent_by_user);
            }
            else {
                UserSuggestionsPool::add_feature_request($title, $form_content, $sent_by_user);
            }
            sleep(2);
            header("Location: support");
            exit();
        }
    }
    private function search_field_is_set() {
        return isset($_GET['username']);
    }

    private function search_field_is_filled() {
        return !empty($_GET['username']);
    }

    public function search_users() {
        require_once("../codeup_res/models/account_manager.php");
        if(!$this->search_field_is_set() || !$this->search_field_is_filled()) {
            $users = AccountManager::get_all_users();
            require_once("../codeup_res/views/search_users.php");
        }
        else {
            $username = $_GET['username'];
            $users = AccountManager::get_users_by_username($username);
            require_once("../codeup_res/views/search_users.php");
        }
    }


    public function user_profile() {
        require_once("../codeup_res/models/account_manager.php");
        require_once("../codeup_res/models/problem_statements_storage.php");
        $username = "";
        if(isset($_GET['id'])) {
            $username = AccountManager::get_username_by_user_id($_GET['id']);
            if($username == FALSE) {
                require_once("../codeup_res/views/error404.php");
                return;
            }
        }
        else {
            $username = $_SESSION['username'];
        }
        $country_and_points = AccountManager::get_country_and_points($username);
        $country = $country_and_points['country'];
        $points = $country_and_points['points'];
        $track_points = ProblemStatementsStorage::get_users_track_points($username);
        require_once("../codeup_res/views/profile.php");
    }


    //these are the functions that Admin or Guest implement
    public function account_confirmation() {
        require_once("../codeup_res/views/error404.php");
    }

    public function register() {
        require_once("../codeup_res/views/error404.php");
    }

    public function login() {
        require_once("../codeup_res/views/error404.php");
    }

    public function review_user_suggestions() {
        require_once("../codeup_res/views/error404.php");
    }

}


?>
