"use strict";
// App Entry Point
const fs = require('fs-extra'),
      _ = require('underscore'),
      tinder = require('tinder'),
      tinderClient = new tinder.TinderClient();

// Setup facebook Credentials
const facebookCredentails = require('./creds/facebook.js');

function onAuth(){
    tinderClient.getRecommendations(10,  function(err, data){
        if(err){
            console.log('An error occured!');
            fs.writeFileSync('errors.json', JSON.stringify(err));
            return;
        }

        if(data.hasOwnProperty('message') && data.message === 'recs exhausted'){
            console.log('Recs Exhausted Waiting for 30 minutes');
            setTimeout(function(){ onAuth(); }, (60 * 1000) * 30);
        }
        else if(data.hasOwnProperty('message') && data.message === 'recs timeout') {
            console.log('Recs Timeout Waiting for 30 minutes');
            setTimeout(function () { onAuth(); }, (60 * 1000) * 30);
        }
        else{
            for(var i=0;i<data.results.length;i++){
                var id = data.results[i]._id;
                var name = data.results[i].name;
                var path = './data/users/'+ id +'.json';

                if(fs.existsSync(path))
                    continue;

                console.log('Wrote Data for ' + name + ' : ' + id);
                fs.writeFileSync(path, JSON.stringify(data.results[i]));
            }

            // Wait for 5 seconds not to overwhelm the server
            setTimeout(function(){ onAuth(); }, 5 * 1000);
        }
    });
}


tinderClient.authorize(
    facebookCredentails.token,
    facebookCredentails.userID,
    onAuth
);