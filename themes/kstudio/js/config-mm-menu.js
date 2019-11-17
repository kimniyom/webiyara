jQuery(document).ready(function ($) {
    var logo = $("#logomini").val();
    $("nav#menu").mmenu({
        "extensions": [
            "pagedim-black",
            "shadow-page"
        ],
        "offCanvas": {
            zposition: "front"
        },
        "searchfield": {
            "placeholder": 'Search...'
        },
        "navbar": {
            title: 'Menu'
        },
        "navbars": [
            {
                "position": "top",
                "content": [
                    '<a href="">' + logo + '</a>'
                ]
            },
            {
                "position": 'top',
                "content": ['searchfield']
            }, {
                "position": 'top',
                "content": ['breadcrumbs']
            },
            {
                "position": "bottom",
                "content": [
                    "<a class='fa fa-envelope' href='#/'></a>",
                    "<a class='fa fa-twitter' href='#/'></a>",
                    "<a class='fa fa-facebook' href='#/'></a>"
                ]
            }
        ]
    });
});