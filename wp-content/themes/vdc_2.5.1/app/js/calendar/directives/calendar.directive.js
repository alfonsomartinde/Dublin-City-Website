angular.module('calendar')
.directive('calendar', function calendarDirective(
  $rootScope,
  constants,
  calendarSrv,
  oppsSrv,
  daySrv
){
  'use strict';

  var today       = new Date();
  var todayMonth  = today.getMonth();
  var todayYear   = today.getFullYear();

  /**
   * Initialisation stuff
   *
   * @param {object} $scope: The current $scope object
   * @return {undefined}
   */
  function init($scope) {
    $scope.dayNames = calendarSrv.getDayNames();
    $scope.weeks    = calendarSrv.getWeeksInMonth(todayMonth, todayYear, 'monday');
    $scope.selected = '';
    $scope.today    = today;
  }

  return {
    restrict: 'E',
    templateUrl: constants.template_directory +
      'app/js/calendar/html/calendar.tmpl.html',
    transclude: false,
    replace: false,
    scope: {},
    controller: function controller($scope) {

      /**
       * Transforms "YYYY-mm-DD HH:mm:ss" into Date object: new Date()
       *
       * @param {type} dateStr - Date in format "YYYY-mm-DD HH:mm:ss"
       * @return {date}
       */
      function dateStrToDate(dateStr) {
        var dateParts = dateStr.split(/[ \/:-]/g);
        return new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
      }

      function getAllDays() {
        var days = [];
        _.each($scope.weeks, function(week){
          days.push(week.days);
        });

        return _.flatten(days);
      }

      function getEventsPerDay() {
        $scope.days = getAllDays();

        _.each($scope.days, function(day){
          var opps = [];

          _.each($scope.opps, function(opp){
            var fromDate = dateStrToDate(opp.from_date);
            var toDate = dateStrToDate(opp.to_date);
            var dateToCheck = day.date;

            if(
              dateToCheck.getTime() >= fromDate.getTime() &&
              dateToCheck.getTime() <= toDate.getTime()
            ) {
              opps.push(opp);
            }
          });

          day.opps = opps;
        });
      }

      /**
       * @TODO
       * Handle Ajax errors
       */
      function getAllPostInMonthError(reason) {

      }

      function getAllPostInMonthSuccess(response) {
        $scope.opps = response;
        getEventsPerDay();
        $rootScope.$emit('oppsLoaded', response);
      }

      function getAllPostWithinCurrentMonth() {
        var date = new Date(),
          y = date.getFullYear(),
          m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        var request = oppsSrv.buildRequest(firstDay, lastDay);

        oppsSrv
          .getPosts(request)
          .then(getAllPostInMonthSuccess , getAllPostInMonthError);
      }

      // $scope.next     = _.noop;
      // $scope.previous = _.noop;
      $scope.next     = function next(){};
      $scope.previous = function previous(){};

      $scope.unselectAllDays = function unselectAllDays() {
        _.each($scope.weeks, function eachWeek(week){
          _.map(week.days, daySrv.unselect);
        });
      };

      init($scope);
      getAllPostWithinCurrentMonth();
    },
    link: function link(){

    }
  };
});