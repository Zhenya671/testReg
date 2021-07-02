<?php

class SiteController extends MainController {

    public function actionIndex() {

        if (self::isGuest()) {
            return $this->render('site/index');
        }

        return $this->render('site/greetings');
    }

    public function actionGreetings() {
        return $this->render('site/greetings');
    }

    public function actionSignin(){

        $users = new Users();

        $activateUser = $users->signInUser($_POST['signInForm']['login']);
        if ($activateUser === true) {

            $numberUser = (int)$users->searchObjectNumberByLogin($_POST['signInForm']['login']);

            if (isset($_POST['check'])){
                Cookie::create($users, $numberUser);
            }

            Session::create($users, $numberUser);

            self::responseJson([
                'success' => true,
                'message' => 'Welcome'
            ]);
        } else {
            self::responseJson([
                'success' => false,
                'message' => implode('<br>', $activateUser)
            ]);
        }

    }

    public function actionSignup(){

        $users = new Users();
        $registerUser = $users->signUpUsers($_POST['signInForm']);
        if ($registerUser === true) {
            self::responseJson([
                'success' => true,
                'message' => 'Thanks for registration, now u can authorization'
            ]);
        } else {
            self::responseJson([
                'success' => false,
                'message' => implode('<br>', $registerUser)
            ]);
        }
    }

    public function actionLogout() {

        Session::delete();

        Cookie::destroy();

        $this->redirect('');

    }

}