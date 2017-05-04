var myApp = angular.module("myApp", []);

myApp.controller("myController", function($scope){
	console.log("In Controller...");

	$scope.newUser = {};
	$scope.clickedUser = {};
	$scope.message = "";

	$scope.users = [
		{username: "Palash", fullname: "Palash Roy", email: "palash@gmail.com"},
		{username: "Sujon", fullname: "Sujon Roy", email: "sujon@gmail.com"},
		{username: "Sujon-11", fullname: "Sujon 11 Roy", email: "sujon11@gmail.com"}
	];

	$scope.saveUser = function(){
		//console.log($scope.newUser);
		$scope.users.push($scope.newUser);
		$scope.newUser = {};
		$scope.message = "New User Added Successfully!";
	};

	$scope.selectUser = function(user){
		//console.log(user);
		$scope.clickedUser = user;
	};

	$scope.updateUser = function(){
		$scope.message = "User Update Successfully!";
	};

	$scope.deleteUser = function(){
		$scope.users.splice($scope.users.indexOf($scope.clickedUser), 1);
		$scope.message = "User Delete Successfully!";
	};

	$scope.clearMessage = function(){
		$scope.message = "";
	};

});