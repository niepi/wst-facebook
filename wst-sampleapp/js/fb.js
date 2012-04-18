// remap jQuery to $
(function ($, window) {

  // CREATE OBJECT FOR UNIQUE NAME SPACE

  if (ol == undefined) {
    var ol = window.ol = {};
  }


  // CALL BIND EVENTS FUNCTION ON DOCUMENT READY

  $(document).ready(function () {

    ol.init();

  });
  // INIT FUNCTION

  ol.init = function () {
    ol.debug = true;
    ol.log('init');
    ol.bindEvents();
    ol.initFB();
  };

  ol.bindEvents = function () {
    ol.log('bind Events');
    
    $('.mfs_button').bind('click',function(){
      ol.sendRequestViaMultiFriendSelector();
    });
  }


  ol.fbEnsureInit = function (callback) {
    if(!window.fbApiInit) {
      setTimeout(function() {ol.fbEnsureInit(callback);}, 50);
    } else {
      if(callback) {
        callback();
      }
    }
  }


  
  ol.initFB = function(){
    ol.fbEnsureInit(function() {
      FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
          // the user is logged in and connected to your
          // app, and response.authResponse supplies
          // the user's ID, a valid access token, a signed
          // request, and the time the access token 
          // and signed request each expire
          ol.uid = response.authResponse.userID;
          ol.accessToken = response.authResponse.accessToken;
          // ol.showDialog();
          // ol.sendAppRequest();
        } else if (response.status === 'not_authorized') {
          // the user is logged in to Facebook, 
          //but not connected to the app
          FB.login({
            scope: 'email,user_birthday',
          });
        } else {
          // the user isn't even logged in to Facebook.
        }
      });
    });
  
  };


  ol.sendRequestViaMultiFriendSelector = function () {
    FB.ui({method: 'apprequests',
    message: 'My Great Request'
    }, function (response) {});
  };               
    
  ol.showDialog = function () {
    // calling the API ...
    var obj = {
      app_id: "340863595924270",
      method: 'feed',
      link: 'https://developers.facebook.com/docs/reference/dialogs/',
      picture: 'http://fbrell.com/f8.jpg',
      name: 'Facebook Dialogs',
      caption: 'Reference Documentation',
      description: 'Using Dialogs to interact with users.',
      display: 'iframe'
    };

    FB.ui(obj, function(){});
  };
    
  // DEBUG FUNCTION

  ol.log = function (msg) {
    if (ol.debug == true) {
      try {
        if (typeof console.log != "undefined") {

          console.log(msg);
        }
        //                if($(msg).find('pre.xdebug-var-dump')){
          //                    ol.alog(msg);
          //                }

          return true;
        } catch (err) {

          return false;
        }
      }
      else {
        return false;
      }
    };
  
    })(jQuery, this);
    
