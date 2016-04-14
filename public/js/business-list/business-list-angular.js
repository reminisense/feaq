/**
 * Created by USER on 4/13/2016.
 */

app.requires.push('ngSanitize');
app.requires.push('angular-loading-bar'); //add angular loading bar
app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

app.controller('businessListController', function($scope, $http){
    $scope.business_list = [];
    $scope.keyword = '';
    $scope.location = 'Location';

    $scope.getBusinessList = function(location, keyword, offset, take){
        location = location ? location : $scope.location;
        keyword = keyword ? keyword : $scope.keyword;
        offset = offset ? offset : '';
        take = take ? take : '';
        var url = '/list/businesses/' + location + '/' + keyword + '/' + offset + '/' + take;
        $http.get(url).success(function(response){
            $scope.business_list = response.businesses;
        });
    }

    $scope.locationFilter = function(location){
        $scope.location = location;
    }

    $scope.alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    $scope.locations = [
        {code : 'Any'},
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

    $scope.getBusinessList();
});