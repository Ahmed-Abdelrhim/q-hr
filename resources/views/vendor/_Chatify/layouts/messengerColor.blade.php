<style>
    /* NProgress background */
    #nprogress .bar{
        background: {{ $messengerColor }} !important;
    }
    #nprogress .peg {
        box-shadow: 0 0 10px {{ $messengerColor }}, 0 0 5px {{ $messengerColor }} !important;
    }
    #nprogress .spinner-icon {
      border-top-color: {{ $messengerColor }} !important;
      border-left-color: {{ $messengerColor }} !important;
    }

    body.theme-1 .m-header svg {
        color: #51459d  ;
    }
    body.theme-2 .m-header svg {

        color: #4ebbd3  ;
    }
    body.theme-3 .m-header svg {
        color: #6fd943 ;
    }
    body.theme-4 .m-header svg {
        color:  #685ee5 ;
    }


    body.theme-1 .Saved_Messages {
        color: #51459d  !important;
    }
    body.theme-2 .Saved_Messages {

        color: #4ebbd3  !important;
    }
    body.theme-3 .Saved_Messages {
        color: #6fd943 !important;
    }
    body.theme-4 .Saved_Messages {
        color:  #685ee5 !important;
    }

    body.theme-1 .m-list-active,
    .m-list-active:hover,
    .m-list-active:focus{
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
    }
    body.theme-2 .m-list-active,
    .m-list-active:hover,
    .m-list-active:focus{
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4ebbd3 99.86%), #1f3996 !important;
    }
    body.theme-3 .m-list-active,
    .m-list-active:hover,
    .m-list-active:focus{
        background: linear-gradient(141.55deg, #6fd943 3.46%, #6fd943 99.86%), #6fd943 !important;
    }
    body.theme-4 .m-list-active,
    .m-list-active:hover,
    .m-list-active:focus{
        background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685ee5 99.86%), #584ed2 !important;
    }

    .m-list-active b{
        background: #fff !important;
        color: {{ $messengerColor }} !important;
    }

    .messenger-list-item td b{
        background: {{ $messengerColor }};
    }

    .messenger-infoView nav a{
        color: {{ $messengerColor }};
    }

    .messenger-infoView-btns a.default{
        color: {{ $messengerColor }};
    }

    body.theme-1 .mc-sender p{
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
    }
    body.theme-2 .mc-sender p{
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, #4ebbd3 99.86%), #1f3996 !important;
    }
    body.theme-3 .mc-sender p{
        background: linear-gradient(141.55deg, #6fd943 3.46%, #6fd943 99.86%), #6fd943 !important;
    }
    body.theme-4 .mc-sender p{
        background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #685ee5 99.86%), #584ed2 !important;
    }

    body.theme-1 .messenger-sendCard button svg {
        color: #51459d  !important;
    }
    body.theme-2 .messenger-sendCard button svg {

        color: #4ebbd3  !important;
    }
    body.theme-3 .messenger-sendCard button svg {
        color: #6fd943 !important;
    }
    body.theme-4 .messenger-sendCard button svg {
        color:  #685ee5 !important;
    }

    .messenger-listView-tabs a,
    .messenger-listView-tabs a:hover,
    .messenger-listView-tabs a:focus{
        color: {{ $messengerColor }};
    }

    body.theme-1 .active-tab{
        border-bottom: 2px solid #51459d  !important; ;
    }
    body.theme-2 .active-tab{

        border-bottom:  2px solid #4ebbd3  !important;
    }
    body.theme-3 .active-tab{
        border-bottom: 2px solid #6fd943 !important;
    }
    body.theme-4 .active-tab{
        border-bottom:  2px solid  #685ee5 !important;
    }

    .msg_minute
    {
        margin: 0px;
    }

    .messenger-favorites div.avatar{
        box-shadow: 0px 0px 0px 2px {{ $messengerColor }};
    }

    .dark-mode-switch{
        color: {{ $messengerColor }};
    }
    .m-list-active .activeStatus{
        border-color: {{ $messengerColor }} !important;
    }
    </style>
