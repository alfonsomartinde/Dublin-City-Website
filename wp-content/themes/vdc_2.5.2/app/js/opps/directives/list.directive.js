angular.module('opps')
.directive('oppsList', function(
  $rootScope,
  constants
){
  'use strict';

  function init($scope) {
    $scope.opps = [];
  }

  return {
    restrict: 'E',
    templateUrl: constants.template_directory +
      'app/js/opps/html/list.tmpl.html',
    transclude: false,
    replace: false,
    scope: {},
    controller: function($scope) {
      function onOppsLoaded(event, response) {
        $scope.opps = response;
      }

      init($scope);

      $rootScope.$on('oppsLoaded', onOppsLoaded)
    },
    link: function(){

    }
  };
});