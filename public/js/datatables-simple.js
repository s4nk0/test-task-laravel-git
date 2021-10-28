/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!*******************************************!*\
      !*** ./resources/js/datatables-simple.js ***!
      \*******************************************/
    window.addEventListener('DOMContentLoaded', function (event) {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki
        var datatablesSimple = document.getElementById('datatablesSimple');

        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple,{
                perPage: 8,
                perPageSelect: [8, 10, 15, 20, 25],
                header: false,
            });
        }
    });
    /******/ })()
;
