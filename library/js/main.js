define(['jquery', 'vendor/steady', 'plugins/jquery-scrollto', 'plugins/isonscreen', 'plugins/isinviewport'], function($, Steady) {





if (screen.width <= 968) {
   // console.log("mobile...exiting");
    return;
  } else {
    
    return;
  }
  




  // Manual for Steady: https://lafikl.github.io/steady.js/

  /*
  * Steady initiates, adds a handler (fn) and a throttle - throttle stops it firing too often.
  * Fire too often and the browser may chug a bit.  Fire too little and a highlight might be 'missed' as 
  * the user scrolls
  */
  var ste = new Steady({
      throttle: 150,
      handler: fn
  });

  ste.addTracker('#scroll-amount', function(el) {

    // the tracker function is a little method to pull a number (or whatever, it could be anything we return)
    // to send to our handler function.  Thus the process goes like this:


    /*

    User Scrolls -> (Throttled) Event Fires 
                                          -> Tracker function gets some data
                                          -> Data from tracker sent to handler function (fn in this case)
                                          -> Fn does whatever we want until we say it's 'done'
                                          -> Scroll event won't fire until the above is finished to avoid 'jank'


    */
      
    // it's really simple, we just want to work out the viewport height and use that to work out where an element is
      return window.scrollY;
  });


   // Addding a
  ste.addCondition('min-#scroll-amount', 0);

  var logo = $('#logo');

  function fn(values, done) {

    var scroll = values['#scroll-amount'];
     

    if (scroll > 400) {
      logo.css('transform', 'scale(0.5,0.5)');
      done();
    } else {
      logo.css('transform', 'scale(1,1)');
      done();
    }

    
  }












  });