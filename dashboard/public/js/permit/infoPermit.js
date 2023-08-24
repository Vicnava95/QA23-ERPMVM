/** EDIT DATA */
$(document).ready(function(){
    $('#quoteInformationOpen').hide();
    $('#projectSitePlanOpen').hide();
    $('#projectSiteListOpen').hide();
    $('#permitsReceiptsOpen').hide();
    $('#permitsAplicationOpen').hide();
    $('#bussinesLicenseOpen').hide();
    $('#cityInspectionOpen').hide();
    $('#jobberQuoteOpen').hide();
    $('#sitePlanOpen').hide();
    $('#othersOpen').hide();
    $('#covenantAOpen').hide();
    $('#anotherDocuOpen').hide();

    $('#quoteInformation').on('hidden.bs.collapse', function () {
        $('#quoteInformationOpen').hide();
        $('#quoteInformationClose').show();
    });
    $('#quoteInformation').on('shown.bs.collapse', function () {
        $('#quoteInformationOpen').show();
        $('#quoteInformationClose').hide();
    });

    $('#projectSitePlan').on('hidden.bs.collapse', function () {
        $('#projectSitePlanOpen').hide();
        $('#projectSitePlanClose').show();
    });
    $('#projectSitePlan').on('shown.bs.collapse', function () {
        $('#projectSitePlanOpen').show();
        $('#projectSitePlanClose').hide();
    });

    $('#projectSiteList').on('hidden.bs.collapse', function () {
        $('#projectSiteListOpen').hide();
        $('#projectSiteListClose').show();
    });
    $('#projectSiteList').on('shown.bs.collapse', function () {
        $('#projectSiteListOpen').show();
        $('#projectSiteListClose').hide();
    });

    $('#permitsReceipts').on('hidden.bs.collapse', function () {
        $('#permitsReceiptsOpen').hide();
        $('#permitsReceiptsClose').show();
    });
    $('#permitsReceipts').on('shown.bs.collapse', function () {
        $('#permitsReceiptsOpen').show();
        $('#permitsReceiptsClose').hide();
    });

    $('#permitsAplication').on('hidden.bs.collapse', function () {
        $('#permitsAplicationOpen').hide();
        $('#permitsAplicationClose').show();
    });
    $('#permitsAplication').on('shown.bs.collapse', function () {
        $('#permitsAplicationOpen').show();
        $('#permitsAplicationClose').hide();
    });

    $('#bussinesLicense').on('hidden.bs.collapse', function () {
        $('#bussinesLicenseOpen').hide();
        $('#bussinesLicenseClose').show();
    });
    $('#bussinesLicense').on('shown.bs.collapse', function () {
        $('#bussinesLicenseOpen').show();
        $('#bussinesLicenseClose').hide();
    });

    $('#cityInspection').on('hidden.bs.collapse', function () {
        $('#cityInspectionOpen').hide();
        $('#cityInspectionClose').show();
    });
    $('#cityInspection').on('shown.bs.collapse', function () {
        $('#cityInspectionOpen').show();
        $('#cityInspectionClose').hide();
    });

    $('#jobberQuote').on('hidden.bs.collapse', function () {
        $('#jobberQuoteOpen').hide();
        $('#jobberQuoteClose').show();
    });
    $('#jobberQuote').on('shown.bs.collapse', function () {
        $('#jobberQuoteOpen').show();
        $('#jobberQuoteClose').hide();
    });

    $('#sitePlan').on('hidden.bs.collapse', function () {
        $('#sitePlanOpen').hide();
        $('#sitePlanClose').show();
    });
    $('#sitePlan').on('shown.bs.collapse', function () {
        $('#sitePlanOpen').show();
        $('#sitePlanClose').hide();
    });

    $('#others').on('hidden.bs.collapse', function () {
        $('#othersOpen').hide();
        $('#othersClose').show();
    });
    $('#others').on('shown.bs.collapse', function () {
        $('#othersOpen').show();
        $('#othersClose').hide();
    });

    $('#covenantA').on('hidden.bs.collapse', function () {
        $('#covenantAOpen').hide();
        $('#covenantAClose').show();
    });
    $('#covenantA').on('shown.bs.collapse', function () {
        $('#covenantAOpen').show();
        $('#covenantAClose').hide();
    });

    $('#anotherDocu').on('hidden.bs.collapse', function () {
        $('#anotherDocuOpen').hide();
        $('#anotherDocuClose').show();
    });
    $('#anotherDocu').on('shown.bs.collapse', function () {
        $('#anotherDocuOpen').show();
        $('#anotherDocuClose').hide();
    });
}); 

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).on('click','#bulk_edit',function(){
    var id = $('#clientID').val();
    $.ajax({
        method:'GET',
        //url: 'http://127.0.0.1:8000/editClientweb/'+id,
        url:'http://127.0.0.1:8000/editClientweb/'+id,
        success:function(data){ 
            $('.modalEditBody').html(data);
        }
    });
});