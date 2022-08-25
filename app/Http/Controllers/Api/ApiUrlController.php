<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api;

class ApiUrlController extends ApiController
{


    /**
     * @return string
     */
    public function postSignUpApiUrl()
    {
        return 'auth/user/profile';
    }

    /**
     * @return string
     */
    public function postLoginApiUrl()
    {
        return 'auth/user/login';
    }

    /**
     * @return string
     */
    public function getFeaturedPackageApiUrl()
    {
        return 'packages/featured';
    }

    /**
     * @return string
     */
    public function getAllPackagesApiUrl()
    {
        return 'package';
    }

    public function getSearchPackageApiUrl($destinationName)
    {
        return "package?destination={$destinationName}";
    }

    public function getTourTypesApiUrl()
    {
        return 'tour_types';
    }


    public function getPackageDetailsApiUrl($packageId)
    {
        return "fixedpackage/{$packageId}";
    }

    public function getPackageConfigurationsApiUrl()
    {
        return 'configs';
    }

    public function postCheckPromoCodeApiUrl()
    {
        return 'promoCode/check';
    }

    public function postBookingApiUrl()
    {
        return 'package/book';
    }

    public function getUserProfileApiUrl($userId)
    {
        return "auth/user/profile/{$userId}";
    }

    public function putProfileUpdateApiUrl($userId)
    {
        return "auth/user/profile/{$userId}";
    }

    public function optionsUsagesHistoryApiUrl($limit,$offset,$userId)
    {
        return "bookedpackage/search?limit={$limit}&offset={$offset}&user_id={$userId}";
    }

    public function postPaymentIpnApiUlr($booking_ref){
        return "payment/ipn/{$booking_ref}";
    }

    public function postPaymentIpnApiUlrForHotel($booking_ref){
        return "hotel/api/hotel/book/payment/ipn/{$booking_ref}";
    }

    public function getHotelSessionCreatApiUrl()
    {
        return 'hotel/api/sessionCreate';
    }

    public function getAllDestinationApiUrl()
    {
        return 'hotel/api/destination/findbyKeyWord/null';
    }

    public function getDestinationByKeywordApiUrl($keyword)
    {
        return "hotel/api/destination/findbyKeyWord/$keyword";
    }

    public function postHotelByMinimumPriceApiUrl()
    {
        return "hotel/api/destination/minimum/price/hotel";
    }

    public function postHotelDetailsByHotelCodeApiUrl()
    {
        return "hotel/api/hotel/search/byHotelCode";
    }

    public function postHotelOptionDetailsApiUrl()
    {
        return "hotel/api/booking/options/details";
    }

    public function postBookHotelApiUrl()
    {
        return "hotel/api/booking/hotel";
    }

    public function getHotelIssueVoucherApiUrl($bookingReference)
    {
        return "hotel/api/hotel/issueVoucher/$bookingReference";
    }

    public function getHotelBookingHistoryApiUrl($userId)
    {
        return "hotel/api/user/booking/records/null/$userId";
    }
    
    public function getSignupVerificationStatus($code)
    {
        return "auth/user/verification/{$code}";
    }

    public function getVisaDescriptionApiUrl()
    {
        return "description";
    }

    public function getVisaDocumentListApiUrl()
    {
        return "visa/document";
    }

    public function getPackageCountryWiseApiUrl(){
        return "fixedpackagecount";
    }

}
