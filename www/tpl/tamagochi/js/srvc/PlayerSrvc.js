'use strict';
var TGC = angular.module('tgc');
TGC.service('PlayerSrvc', function() {
	
	var PlayerSrvc = this;
	PlayerSrvc.OWN = null;
	PlayerSrvc.CACHE = null;

	PlayerSrvc.cache = function(newcache) {
		console.log("PlayerSrc.cache()", newcache);
		PlayerSrvc.CACHE = newcache ? newcache : PlayerSrvc.CACHE;
		return PlayerSrvc.CACHE;
	};

	PlayerSrvc.pingData = function(data) {
		console.log("PlayerSrc.pingData()", data);
		PlayerSrvc.OWN = new window.TGC.Player(data);
	};
	
	
	
});
