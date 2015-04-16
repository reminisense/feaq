/**
 * Created by JONAS on 3/4/2015.
 */
(function() {
    app.controller('searchBusinessCtrl', function($scope, $http) {
        jQuery.ajax({
            url: '//freegeoip.net/json/',
            type: 'POST',
            dataType: 'jsonp',
            success: function(location) {
                $scope.location_filter = location.country_name;
            }
        });

        $scope.industry_filter = 'Industry';

        $scope.searchBusiness = (function(location, industry) {
            if (typeof $scope.search_keyword == 'undefined') $scope.search_keyword = '';
            if (typeof $scope.time_open == 'undefined') $scope.time_open = '';
            $http.post('/business/filter-search', {
                "keyword": $scope.search_keyword,
                "country": location,
                "industry": industry,
                "time_open": $scope.time_open
            }).success(function(response) {
                $('#biz-grid').hide();
                $scope.businesses = new Array();
                var length_limit = 7;
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses.push({
                        "business_id": response[i].business_id,
                        "business_name": response[i].business_name,
                        "local_address": response[i].local_address,
                        "time_open" : response[i].time_open,
                        "time_close": response[i].time_close,
                        "waiting_time": response[i].waiting_time
                    });
                    if(i == length_limit - 1) break;
                }

                if(response.length <= length_limit){
                    length_limit = response.length;
                }
                $scope.searchLabel= 'Showing Top '+ length_limit +' Result(s)';
                $('#search-grid').show();
            });
        });

        $scope.locationFilter = (function(location) {
            $scope.location_filter = location;
            console.log(location);
        });

        $scope.industryFilter = (function(industry) {
            $scope.industry_filter = industry;
        });

        //added the industry filters here so that they can be displayed using ng-repeat
        $scope.industries = [
            {code :'Accounting'},               {code :'Advertising'},                  {code :'Agriculture'},              {code :'Air Services'},
            {code :'Airlines'},                 {code :'Apparel'},                      {code :'Appliances'},               {code :'Auto Dealership'},
            {code :'Banking'},                  {code :'Broadcasting'},                 {code :'Business Services'},        {code :'Communications'},
            {code :'Corporate'},                {code :'Customer Service'},             {code :'Delivery'},                 {code :'Delivery Services'},
            {code :'Education'},                {code :'Energy'},                       {code :'Entertainment'},            {code :'Events'},
            {code :'Food and Beverage'},        {code :'Government'},                   {code :'Grocery'},                  {code :'Healthcare'},
            {code :'Hobbies and Collections'},  {code :'Hospitality'},                  {code :'Insurance'},                {code :'Information Technology'},
            {code :'Lifestyle'},                {code :'Mail Order Services'},          {code :'Manufacturing'},            {code :'Pharmaceutical'},
            {code :'Media'},                    {code :'Professional services'},        {code :'Publishing'},               {code :'Real Estate'},
            {code :'Recreation'},               {code :'Rentals'},                      {code :'Retail'},                   {code :'Software Development'},
            {code :'Technology'},               {code :'Travel and Tours'},             {code :'Utility services'},         {code :'Web Services'},
            {code :'Wholesale'},
        ];

        //added the location filters here so that they can be displayed using ng-repeat
        $scope.locations = [
            {code : 'Afghanistan'},             {code : 'Albania'},                     {code : 'Algeria'},                 {code : 'Andorra'},
            {code : 'Angola'},                  {code : 'Antigua and Barbuda'},         {code : 'Argentina'},               {code : 'Armenia'},
            {code : 'Aruba'},                   {code : 'Australia'},                   {code : 'Austria'},                 {code : 'Azerbaijan'},
            {code : 'Bahamas'},                 {code : 'Bahrain'},                     {code : 'Bangladesh'},              {code : 'Barbados'},
            {code : 'Belarus'},                 {code : 'Belgium'},                     {code : 'Belize'},                  {code : 'Benin'},
            {code : 'Bhutan'},                  {code : 'Bolivia'},                     {code : 'Bosnia and Herzegovina'},  {code : 'Botswana'},
            {code : 'Brazil'},                  {code : 'Brunei'},                      {code : 'Bulgaria'},                {code : 'Burkina Faso'},
            {code : 'Burma'},                   {code : 'Burundi'},                     {code : 'Cambodia'},                {code : 'Cameroon'},
            {code : 'Canada'},                  {code : 'Cape Verde'},                  {code : 'Central African Republic'},{code : 'Chad'},
            {code : 'Chile'},                   {code : 'China'},                       {code : 'Colombia'},                {code : 'Comoros'},
            {code : 'Congo'},                   {code : 'Costa Rica'},                  {code : 'Cote dIvoire'},            {code : 'Croatia'},
            {code : 'Cuba'},                    {code : 'Curacao'},                     {code : 'Cyprus'},                  {code : 'Czech Republic'},
            {code : 'Denmark'},                 {code : 'Djibouti'},                    {code : 'Dominica'},                {code : 'Dominican Republic'},
            {code : 'East Timor'},              {code : 'Ecuador'},                     {code : 'Egypt'},                   {code : 'El Salvador'},
            {code : 'Equatorial Guinea'},       {code : 'Eritrea'},                     {code : 'Estonia'},                 {code : 'Ethiopia'},
            {code : 'Fiji'},                    {code : 'Finland'},                     {code : 'France'},                  {code : 'Gabon'},
            {code : 'Gambia'},                  {code : 'Georgia'},                     {code : 'Germany'},                 {code : 'Ghana'},
            {code : 'Greece'},                  {code : 'Grenada'},                     {code : 'Guatemala'},               {code : 'Guinea'},
            {code : 'Guinea-Bissau'},           {code : 'Guyana'},                      {code : 'Haiti'},                   {code : 'Holy See'},
            {code : 'Honduras'},                {code : 'Hong Kong'},                   {code : 'Hungary'},                 {code : 'Iceland'},
            {code : 'India'},                   {code : 'Indonesia'},                   {code : 'Iran'},                    {code : 'Iraq'},
            {code : 'Ireland'},                 {code : 'Israel'},                      {code : 'Italy'},                   {code : 'Jamaica'},
            {code : 'Japan'},                   {code : 'Jordan'},                      {code : 'Kazakhstan'},              {code : 'Kenya'},
            {code : 'Kiribati'},                {code : 'Kosovo'},                      {code : 'Kuwait'},                  {code : 'Kyrgyzstan'},
            {code : 'Laos'},                    {code : 'Latvia'},                      {code : 'Lebanon'},                 {code : 'Lesotho'},
            {code : 'Liberia'},                 {code : 'Libya'},                       {code : 'Liechtenstein'},           {code : 'Lithuania'},
            {code : 'Luxembourg'},              {code : 'Macau'},                       {code : 'Macedonia'},               {code : 'Madagascar'},
            {code : 'Malawi'},                  {code : 'Malaysia'},                    {code : 'Maldives'},                {code : 'Mali'},
            {code : 'Malta'},                   {code : 'Marshall Islands'},            {code : 'Mauritania'},              {code : 'Mauritius'},
            {code : 'Mexico'},                  {code : 'Micronesia'},                  {code : 'Moldova'},                 {code : 'Monaco'},
            {code : 'Mongolia'},                {code : 'Montenegro'},                  {code : 'Morocco'},                 {code : 'Mozambique'},
            {code : 'Namibia'},                 {code : 'Nauru'},                       {code : 'Nepal'},                   {code : 'Netherlands'},
            {code : 'Netherlands Antilles'},    {code : 'New Zealand'},                 {code : 'Nicaragua'},               {code : 'Niger'},
            {code : 'Nigeria'},                 {code : 'North Korea'},                 {code : 'Norway'},                  {code : 'Oman'},
            {code : 'Pakistan'},                {code : 'Palau'},                       {code : 'Panama'},                  {code : 'Papua New Guinea'},
            {code : 'Peru'},                    {code : 'Philippines'},                 {code : 'Portugal'},                {code : 'Qatar'},
            {code : 'Romania'},                 {code : 'Russia'},                      {code : 'Rwanda'},                  {code : 'Saint Kitts and Nevis'},
            {code : 'Saint Lucia'},             {code : 'Saint Vincent and the Grenadines'},                                {code : 'Samoa'},
            {code : 'San Marino'},              {code : 'Sao Tome and Principe'},       {code : 'Saudi Arabia'},            {code : 'Senegal'},
            {code : 'Serbia'},                  {code : 'Seychelles'},                  {code : 'Sierra Leone'},            {code : 'Singapore'},
            {code : 'Sint Maarten'},            {code : 'Slovakia'},                    {code : 'Slovenia'},                {code : 'Solomon Islands'},
            {code : 'Somalia'},                 {code : 'South Africa'},                {code : 'South Korea'},             {code : 'South Sudan'},
            {code : 'Spain'},                   {code : 'Sri Lanka'},                   {code : 'Sudan'},                   {code : 'Suriname'},
            {code : 'Swaziland'},               {code : 'Sweden'},                      {code : 'Switzerland'},             {code : 'Syria'},
            {code : 'Taiwan'},                  {code : 'Tajikistan'},                  {code : 'Tanzania'},                {code : 'Thailand'},
            {code : 'Timor-Leste'},             {code : 'Togo'},                        {code : 'Tonga'},                   {code : 'Tunisia and Tobago'},
            {code : 'Tunisia'},                 {code : 'Turkey'},                      {code : 'Turkmenistan'},            {code : 'Tuvalu'},
            {code : 'Uganda'},                  {code : 'Ukraine'},                     {code : 'United Arab Emirates'},    {code : 'United Kingdom'},
            {code : 'Uruguay'},                 {code : 'Uzbekistan'},                  {code : 'Vanuatu'},                 {code : 'Venezuela'},
            {code : 'Vietnam'},                 {code : 'Yemen'},                       {code : 'Zambia'},                  {code : 'Zimbabwe'}
        ];
    });
})();