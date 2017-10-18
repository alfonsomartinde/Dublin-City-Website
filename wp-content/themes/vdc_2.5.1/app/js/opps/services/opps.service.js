angular.module('opps')
.factory('oppsSrv', function(
  $filter,
  oppsDaoSrv
) {
  'use strict';

  /**
   * @TODO return string depending on format parameter
   *
   * @param {date} date - date to transform
   * @param {string} format - The output format
   * @return {string} - The formated date
   */
  function formatDate(date, format) {
    var year = date.getFullYear();
    var month = date.getMonth();
    var day = date.getDay();

    if (year === '' || month === '' || day === '') {
      return '';
    }

    return year + '-' + month + '-' + day;
  }

  /**
   * Builds the request object used in calendarDaoSrv
   *
   * @usage:
   *
   *    buildRequest(dateStart) --> Will return post just for that day
   *    buildRequest(dateStart, dateEnd) --> Will return post between those dates
   *
   * @expected response:
   *
   *    /wp-json/wp/v2/opps-api?
   *      meta_query[0][key]=from_date&
   *      meta_query[0][value][0]=2017-10-10&
   *      meta_query[0][value][1]=2017-10-13&
   *      meta_query[0][compare]=BETWEEN&
   *      meta_query[1][type]=DATE
   *
   * @param {date} dateStart - We'll request post from this date
   * @param {date} dateEnd - (Optional) We'll request posts until this date
   * @return {object} - The request
   */
  function buildRequest(dateStart, dateEnd) {
    var request;
    // var dateStartFormated = dateStart && formatDate(dateStart, 'Y-m-d');
    var dateStartFormated = dateStart && $filter('date')(dateStart, 'yyyy-MM-dd');
    var dateEndFormated = dateEnd && $filter('date')(dateEnd, 'yyyy-MM-dd');

    if (!_.isDate(dateEnd)) {
      request = {
        'meta_query[relation]': 'AND',
        'meta_query[0][key]': 'from_date',
        'meta_query[0][value]': dateStartFormated,
        'meta_query[0][compare]': '<=',
        'meta_query[0][type]': 'DATE',
        'meta_query[1][key]': 'to_date',
        'meta_query[1][value]': dateStartFormated,
        'meta_query[1][compare]': '>=',
        'meta_query[1][type]': 'DATE'
      };
    } else {
      request = {
        'meta_query[0][key]': 'from_date',
        'meta_query[0][value][0]': dateStartFormated,
        'meta_query[0][value][1]': dateEndFormated,
        'meta_query[0][compare]': 'BETWEEN',
        'meta_query[0][type]': 'DATE'
      };
    }

    return request;
  }

  function getPosts(request) {
    return oppsDaoSrv.getPosts(request);
  }

  // Public API
  return {
    'buildRequest': buildRequest,
    'getPosts': getPosts
  };
});