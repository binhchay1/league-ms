@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Privacy') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center padding-0">{{ __('Privacy Policy') }}</h1>
    </div>
</section>

<section id="privacy" class="container">
    <div>
        <h2 class="h24px">{{ env('APP_NAME', 'Badminton.io') }} {{ __('and GDPR') }}</h2>
        <p class="wcs-page_body">
            {{ __('Please also see the') }} {{ env('APP_NAME', 'Badminton.io') }} <a href="/terms.html"> {{ __('Terms and Conditions.') }}</a> {{ __('Our terms and conditions require all leagues and clubs who use') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('within the EU to be GDPR compliant.') }}
            {{ __('Leagues are responsible for managing the "individual rights" of the individuals they are keeping data for in their leagues.') }}
        </p>

        <p class="wcs-page_body">{{ __("User's are not permitted to have a") }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('account (login / sign-in) unless they are 16 years old or over.') }}</p>

       <h2 class="h24px">{{ env('APP_NAME', 'Badminton.io') }} {{ __('holds the following data on an individual with a') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('account') }}:</h2>
        <ul>
            <li>{{ __('Name') }}</li>
            <li>{{ __('Email address') }}</li>
            <li>{{ __('Encrypted login credentials') }}</li>
            <li>{{ __('Support questions history') }}</li>
        </ul>

        <p class="bold wcs-page_body">{{ __('This information is held by') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('as the "Controller" for the purposes of') }}:</p>
        <ul class="wcs-page_body">
            <li>{{ __('Allowing the user to sign into the') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('system') }}</li>
            <li>{{ __('Provide the user with a platform for customer chat and support') }}</li>
        </ul>

        <p class="bold wcs-page_body">{{ __('This data is passed to the following external systems') }}:</p>
        <ul  class="wcs-page_body">
            <li><a href="https://www.intercom.com/">Intercom</a> {{ __('platform for customer support,') }} <a href="https://www.intercom.com/terms-and-policies#privacy">{{ __('Intercom privacy') }}</a></li>
            <li><a href="https://stripe.com">Stripe</a> {{ __('to manage online payments,') }} <a href="https://stripe.com/privacy">{{ __('Stripe privacy') }}</a></li>
        </ul>

        <p  class="wcs-page_body">{{ __('We do not pass this information to anyone else for marketing or any other purposes, so there is not an opt-in for any additional options.') }}</p>

       <h2 class="h24px">{{ env('APP_NAME', 'Badminton.io') }} {{ __('holds data on league members on behalf of leagues') }}</h2>
        <p  class="wcs-page_body">
            {{ __('As a "Processor"') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('holds personal data of league members who do not have a') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('account, on behalf of leagues.') }}
            {{ __("For example, a League Administrator could create a 'Player' in the system who won't have a") }} {{ env('APP_NAME', 'Badminton.io') }} {{ __("account and therefore won't be able to sign-in to the") }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('system.') }}
        </p>

        <p class="bold wcs-page_body">{{ __('The following personal data of league members without') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('accounts') }}:</p>
        <ul class="pause">
            <li>{{ __('Email address') }}</li>
            <li>{{ __('Mobile phone number') }}</li>
        </ul>
        <p  class="wcs-page_body">{{ __('The above can be used by the') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('to provide email notifications (after an opt-in) and result entry SMS message prompts. It will not be used for marketing purposes.') }}</p>

        <p class="bold wcs-page_body">{{ env('APP_NAME', 'Badminton.io') }}  {{__('will not use the following personal data of league members collected by leagues for any purpose:')}}</p>
        <ul class="wcs-page_body">
            <li>{{ __('Date Of Birth') }}</li>
            <li>{{ __('League reference numbers') }}</li>
            <li>{{ __('Address') }}</li>
        </ul>

        <h2 class="h24px">{{ __('Leagues and clubs are "Controllers" for the purposes of GDPR') }}</h2>
        <p class="wcs-page_body">
            {{ __('A league may use many systems to manage their sports league and personal details about their members can cross many systems, some of which may be paper or spreadsheet based. For the purposes of GDPR a league is a "Controller" of this information and if it resides in the') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('system then') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('is a "Processor" of this information.') }}
        </p>

       <p class="bold wcs-page_body">{{ __('Leagues use') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('to manage their day to day activities including:') }}</p>
        <ul class="wcs-page_body">
            <li>{{ __('Scheduling') }}</li>
            <li>{{ __('Results management') }}</li>
            <li>{{ __('Statistics management') }}</li>
            <li>{{ __('People management for administrators, referees and players') }}</li>
        </ul>

        <p class="bold wcs-page_body">{{ __('Minimum personal data held within') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('about league members in the league:') }}</p>
        <ul class="wcs-page_body">
            <li>{{ __('Name') }}</li>
        </ul>

        <p class="bold wcs-page_body">{{ __('And optionally:') }}</p>
        <ul class="wcs-page_body">
            <li>{{ __('Email address') }}</li>
            <li>{{__('Date Of Birth')}}</li>
            <li>{{__('League reference numbers')}}</li>
            <li>{{__('Telephone contact details')}}</li>
            <li>{{__('Address')}}</li>
        </ul>

       <h2 class="h24px">{{ __("Display the league's own privacy policy") }}</h2>
        <p class="wcs-page_body">{{ __("You can upload your own privacy policy under 'Site Builder < Documents'. In here you can state how and what personal data you collect and how you store, what you do with it, i.e. your purpose and which third parties you share the data with.") }}</p>

       <h2 class="h24px">{{ __('Leagues must comply with the GDPR "Individual Rights"') }}</h2>

        <p class="bold wcs-page_body">{{ __('Right to be informed') }}</p>
        <p class="wcs-page_body">{{ __("This can be implemented in the league's privacy policy.") }}</p>
        <p class="wcs-page_body">{{ __('If the league uses the') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __("Player Registration system then consent can be obtained by requiring league members to accept the league's terms / privacy policy when registering for the league.") }}</p>

        <p class="bold wcs-page_body">{{ __('Right of access') }}</p>
        <p class="wcs-page_body">{{ __('Individuals have a right to access their personal data.') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('provide a web page detailing personal information and related league sports data about an individual which a league can give to that individual.') }}</p>

        <p class="bold wcs-page_body">{{ __('Right to rectification') }}</p>
        <p class="wcs-page_body">{{ __('All data relating to an individual can be corrected by any League Administrator within a league.') }}</p>

        <p class="bold wcs-page_body">{{ __('Right to erasure') }}</p>
        <p class="wcs-page_body">{{ __('We provide the tools to completely erase a person in your league. There is no way to revert this. All personal data will be deleted and the player or person will have a first name and last name anonymized.') }}</p>

        <p class="bold wcs-page_body">{{ __('Right to restrict process') }}</p>
        <p class="wcs-page_body">{{ __('We provide the tools to restrict the processing of an individual. Their personal details will not be viewable within the administration system or the public sites and their first name and last name are anonymized.') }}</p>

        <h2 class="h24px">{{ __('Where we store your personal data') }}</h2>
        <p class="wcs-page_body">{{ __('All') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('data is stored using') }} "<a href="https://aws.amazon.com/">Amazon Web Services</a> (AWS)", {{ __('they are a subsidiary of Amazon.com that provides a cloud computing platform for') }} {{ env('APP_NAME', 'Badminton.io') }}. <a href="https://aws.amazon.com/privacy/">AWS {{ __('Privacy') }}</a></p>
        <p class="wcs-page_body">{{ __('All passwords are encrypted. The administration pages all operate under https, this means all communications between your browser and the website are encrypted.') }}</p>

        <h2 class="h24px">{{ __('Use of Intercom Services') }}</h2>
        <p class="wcs-page_body">
            {{ __('We use third-party analytics services to help understand your usage of our services. In particular, we provide a limited amount of your information (such as your email address and sign-up date) to Intercom, Inc. ("Intercom") and utilize Intercom to collect data for analytics purposes when you visit our website or use our product. Intercom analyzes your use of our website and/or product and tracks our relationship so that we can improve our service to you. We may also use Intercom as a medium for communications, either through email, or through messages within our product(s). As part of our service agreements, Intercom collects publicly available contact and social information related to you, such as your email address, gender, company, job title, photos, website URLs, social network handles and physical addresses, to enhance your user experience.') }}
            {{ __('For more information on the privacy practices of') }} Intercom, {{ __('please visit') }} <a href="https://www.intercom.com/terms-and-policies#privacy">Intercom privacy</a>. Intercom's services are governed by Intercom's terms of use which can be found at <a href="https://www.intercom.com/terms-and-policies#terms">Intercom terms</a>.
        </p>

        <h2 class="h24px">{{ __('Use of Smartlook Services') }}</h2>
        <p class="wcs-page_body">
            {{ __("We have engaged Smartlook to analyst the user behavior of visitors to this website and provide research information designed to improve the customer experience. Smartlook's standard use of cookies and other tracking technologies can enable it to have access to Personal Information of visitors to this website. Such access to and use of Personal Information by Inspectlet is governed by") }} <a href="https://help.smartlook.com/en/articles/3244452-privacy-policy">{{ __("Smartlook's Privacy Policy") }}</a>.
            {{ __('Note: we do not allow Smartlook to record sensitive information input into our forms such as first name, last name, date of birth, email address or password.') }}
        </p>

        <h2 class="h24px">{{ __('Use of Amplitude Services') }}</h2>
        <p class="wcs-page_body">
            {{ __('We use the services of Amplitude, Inc. ("Amplitude") to process our business intelligence data (graphs, dashboards). The data processing takes place on the basis of our legitimate interests (Art. 6 (1) lit. f GDPR) of analyzing user behavior. Amplitude receives a pseudonymity') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('ID and interaction data from us for this purpose.') }}
            {{ __('For more information about data processing by Amplitude, see the') }} <a href="https://amplitude.com/privacy">Amplitude Privacy Policy</a>.
        </p>

        <h2 class="h24px">{{ __('Cookies') }}</h2>
        <p class="wcs-page_body">{{ __('This policy gives the following information about cookies:') }}</p>
        <ul class="wcs-page_body">
            <li>{{ __('what they are;') }}</li>
            <li>{{ __('which ones are used by') }} {{ env('APP_NAME', 'Badminton.io') }} ("LR");</li>
            <li>{{ __('the purposes for which they are used; and') }}</li>
            <li>{{ __('how you can manage and/or disable them.') }}</li>
        </ul>
        <p class="wcs-page_body">{{ __("Cookies are small text files which are placed on your device when you visit a website. They contain information that is transferred to your device's hard drive and help us to improve our site and to deliver a better and more personalized service to you. Cookies enable us to:") }}</p>
        <ul class="wcs-page_body">
            <li>{{ __('estimate our audience size and usage pattern;') }}</li>
            <li>{{ __('store information about your preferences, and so allow us to customize our site according to your individual interests; and') }}</li>
            <li>{{ __('recognize you when you return to our site.') }}</li>
        </ul>
        <p class="wcs-page_body">{{ __('The cookies used on this website have been categorized based on the categories found in the ICC UK Cookie guide. A list of all the cookies used on this website by category is set out below.') }}</p>

       <h2 class="h24px">{{ __('Category 1 - Strictly Necessary Cookies') }}</h2>

        <p class="bold wcs-page_body">{{ __('These cookies enable services you have specifically asked for.') }}</p>

        <p class="wcs-page_body">{{ __('These cookies are essential in order to enable you to move around the website and use its features, such as accessing secure areas of the website. Without these cookies, services you require, like results, statistics, standings and news cannot be provided.') }}</p>

        <table>
            <thead>
                <tr>
                    <td>{{ __('Cookie Name') }}</td>
                    <td>{{ __('Description') }}</td>
                    <td>{{ __('Expiry') }}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>JSESSIONID</td>
                    <td>{{ __("This cookie contains a session ID which is a mechanism for distinguishing different users' visits when multiple users are visiting the website at the same time. It is essential for interactive use of the site.") }}</td>
                    <td>{{ __('On closing the web browser') }}</td>
                </tr>
            </tbody>
        </table>

       <h2 class="h24px">{{ __('Category 2 - Performance Cookies') }}</h2>

        <p class="bold wcs-page_body">{{ __('These cookies collect anonymous information about the pages visited by you') }}</p>

        <p class="wcs-page_body">{{ __("These cookies collect information about how visitors use a website, for instance which pages visitors go to most often, and if they get error messages from web pages. These cookies don't collect information that identifies a visitor. All information these cookies collect is aggregated and therefore anonymous. It is only used to improve how a website works.") }}</p>

        <table>
            <thead>
                <tr>
                    <td>{{ __('Cookie Name') }}</td>
                    <td>{{ __('Description') }}</td>
                    <td>{{ __('Expiry') }}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>__utma</td>
                    <td>{{__('This cookie is typically written to the browser upon the first visit to our site from that web browser. If the cookie has been deleted by the browser operator, and the browser subsequently visits our site, a new __utma cookie is written with a different unique ID. This cookie is used to determine unique visitors to our site and it is updated with each page view. Additionally, this cookie is provided with a unique ID that Google Analytics uses to ensure both the validity and accessibility of the cookie as an extra security measure.')}} </td>
                    <td>{{__('2 years from set/update')}}</td>
                </tr>
                <tr>
                    <td>__utmb</td>
                    <td>{{__('This cookie is used to establish and continue a user session with our site. When a user views a page on our site, the Google Analytics code attempts to update this cookie. If it does not find the cookie, a new one is written and a new session is established. Each time a user visits a different page on our site; this cookie is updated to expire in 30 minutes, thus continuing a single session for as long as user activity continues within 30-minute intervals. This cookie expires when a user pauses on a page on our site for longer than 30 minutes.')}}</td>
                    <td>3{{ __('0 minutes from set/update') }}</td>
                </tr>
                <tr>
                    <td>__utmc</td>
                    <td>{{ __('This cookie operates in conjunction with the __utmb cookie to determine whether or not to establish a new session for the user. ') }}</td>
                    <td>{{ __('On closing the web browser') }}</td>
                </tr>
                <tr>
                    <td>__utmz</td>
                    <td>{{ __('This cookie stores the type of referral used by the visitor to reach our site, whether via a direct method, a referring link, a website search, or a campaign such as an ad or an email link. It is used to calculate search engine traffic, ad campaigns and page navigation within our own site. The cookie is updated with each page view to our site. ') }}</td>
                    <td>{{ __('6 months from set/update') }}</td>
                </tr>
            </tbody>
        </table>

       <h2 class="h24px">{{ __('Category 3 - Functionality Cookies') }}</h2>
        <p class="bold wcs-page_body">{{ __('These cookies remember choices you make to improve your experience.') }}</p>
        <p class="wcs-page_body">{{ __('We do not use this type of cookie directly on our website.') }}</p>
        <p class="wcs-page_body">{{ __('We offer a support chat facility on our website via') }} www.whoson.com , {{ __('please visit their website for details of the') }} <a href="http://www.whoson.com/privacy.aspx" target="_blank">{{ __('Whoson privacy policy') }}</a></p>

       <h2 class="h24px">{{ __('Category 4 - Targeting / Advertising Cookies') }}</h2>
        <p class="bold wcs-page_body">{{__('These cookies collect information about your browsing habits in order to make advertising relevant to you and your interests.')}}</p>
        <p class="wcs-page_body">{{ __('LR does not directly store cookies related to advertising from our website. We serve adverts via Google DoubleClick for Publishers Small Business and Google Adsense. Please see') }}<a href="http://www.google.com/policies/privacy/ads/" target="_blank">{{ __('Googles advertising privacy statements') }}</a></p>

       <h2 class="h24px">{{ __('Restricting and blocking cookies') }}</h2>
        <p class="wcs-page_body">{{ __('If you wish to restrict or block the cookies which are set by our websites, or any other website, you can do this through your browser settings. The Help function within your browser should tell you how.') }}</p>
        <p class="wcs-page_body">{{ __('Alternatively, visit www.aboutcookies.org which contains comprehensive information on how to restrict or block the cookies on a wide variety of browsers. This site provides details on how to delete cookies from your computer as well as more general information about cookies.') }}</p>
        <p class="wcs-page_body">{{ __('For information on how to do this on the browser of your mobile phone you will need to refer to your handset manual.') }}</p>
        <p class="wcs-page_body">{{ __('Click here to') }} <a href="http://tools.google.com/dlpage/gaoptout" target="_blank">{{__('opt out of being tracked by Google Analytics across all websites')}}</a></p>
        <p class="wcs-page_body">{{ __('Please be aware that restricting cookies may impact on the functionality of our website.') }}</p>
        <p class="wcs-page_body">{{ __('To obtain further information on the ICC (UK) UK cookie guide visit') }} <a href="http://www.international-chamber.co.uk/our-expertise/digitaleconomy" target="_blank">http://www.international-chamber.co.uk/our-expertise/digitaleconomy</a></p>

        <h2 class="h24px">{{ __('Changes to our privacy policy') }}</h2>
        <p class="wcs-page_body">{{ __('Any changes we may make to our privacy policy in the future will be posted on this page. This policy was last updated: ') }}<strong>{{ __('26 September 2022') }}</strong></p>

        <h2 class="h24px">{{__('Contact')}}</h2>
        <p class="wcs-page_body">{{ __('Questions, comments and requests regarding this privacy policy should be addressed to') }} {{ env('APP_NAME', 'Badminton.io') }}, DJH Technology Ltd, Granville House, 2 Tettenhall Rd, Wolverhampton WV1 4SB, United Kingdom or <a class="lowercase" href="#" onclick="Intercom('showNewMessage');return false;">Contact Us</a></p>

    </div>
</section>
@endsection
