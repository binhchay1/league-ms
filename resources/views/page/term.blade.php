@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Privacy') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Privacy Policy') }}</h1>
    </div>
</section>

<section id="privacy" class="container">
    <div>
        <h2 class="h24px">{{ env('APP_NAME', 'Badminton.io') }} and GDPR</h2>
        <p>
            {{ __('Please also see the') }} {{ env('APP_NAME', 'Badminton.io') }} <a href="/terms.html"> {{ __('Terms and Conditions') }}</a>. Our terms and conditions require all leagues and clubs who use {{ env('APP_NAME', 'Badminton.io') }} within the EU to be GDPR compliant.
            {{ __('Leagues are responsible for managing the "individual rights" of the individuals they are keeping data for in their leagues.') }}
        </p>

        <p>User's are not permitted to have a {{ env('APP_NAME', 'Badminton.io') }} account (login / sign-in) unless they are 16 years old or over.</p>

        <h3>{{ env('APP_NAME', 'Badminton.io') }} holds the following data on an individual with a {{ env('APP_NAME', 'Badminton.io') }} account:</h3>
        <ul>
            <li>Name</li>
            <li>Email address</li>
            <li>Encrypted login credentials</li>
            <li>Support questions history</li>
        </ul>

        <p class="bold">This information is held by {{ env('APP_NAME', 'Badminton.io') }} as the "Controller" for the purposes of:</p>
        <ul>
            <li>Allowing the user to sign into the {{ env('APP_NAME', 'Badminton.io') }} system</li>
            <li>Provide the user with a platform for customer chat and support</li>
        </ul>

        <p class="bold">This data is passed to the following external systems:</p>
        <ul>
            <li><a href="https://www.intercom.com/">Intercom</a> platform for customer support, <a href="https://www.intercom.com/terms-and-policies#privacy">Intercom privacy</a></li>
            <li><a href="https://stripe.com">Stripe</a> to manage online payments, <a href="https://stripe.com/privacy">Stripe privacy</a></li>
        </ul>

        <p>We do not pass this information to anyone else for marketing or any other purposes, so there is not an opt-in for any additional options.</p>

        <h3>{{ env('APP_NAME', 'Badminton.io') }} holds data on league members on behalf of leagues</h3>
        <p>
            As a "Processor" {{ env('APP_NAME', 'Badminton.io') }} holds personal data of league members who do not have a {{ env('APP_NAME', 'Badminton.io') }} account, on behalf of leagues.
            For example, a League Administrator could create a "Player" in the system who won't have a {{ env('APP_NAME', 'Badminton.io') }} account and therefore won't be able to sign-in to the {{ env('APP_NAME', 'Badminton.io') }} system.
        </p>

        <p class="bold">The following personal data of league members without {{ env('APP_NAME', 'Badminton.io') }} accounts:</p>
        <ul class="pause">
            <li>Email address</li>
            <li>Mobile phone number</li>
        </ul>
        <p>The above can be used by the {{ env('APP_NAME', 'Badminton.io') }} to provide email notifications (after an opt-in) and result entry SMS message prompts. It will not be used for marketing purposes.</p>

        <p class="bold">{{ env('APP_NAME', 'Badminton.io') }} will not use the following personal data of league members collected by leagues for any purpose:</p>
        <ul>
            <li>Date Of Birth</li>
            <li>League reference numbers</li>
            <li>Address</li>
        </ul>

        <h2 class="h24px">Leagues and clubs are "Controllers" for the purposes of GDPR</h2>
        <p>
            A league may use many systems to manage their sports league and personal details about their members can cross many systems, some of which may be paper or spreadsheet based. For the purposes of GDPR a league is a "Controller" of this information and if it resides in the {{ env('APP_NAME', 'Badminton.io') }} system then {{ env('APP_NAME', 'Badminton.io') }} is a "Processor" of this information.
        </p>

        <h3>Leagues use {{ env('APP_NAME', 'Badminton.io') }} to manage their day to day activities including:</h3>
        <ul>
            <li>Scheduling</li>
            <li>Results management</li>
            <li>Statistics management</li>
            <li>People management for administrators, referees and players</li>
        </ul>

        <h3>Minimum personal data held within {{ env('APP_NAME', 'Badminton.io') }} about league members in the league:</h3>
        <ul>
            <li>Name</li>
        </ul>

        <h3>And optionally:</h3>
        <ul>
            <li>Email address</li>
            <li>Date Of Birth</li>
            <li>League reference numbers</li>
            <li>Telephone contact details</li>
            <li>Address</li>
        </ul>

        <h2 class="h24px">{{ env('APP_NAME', 'Badminton.io') }} provides leagues with the following tools</h2>
        <h3>Display the league's own privacy policy</h3>
        <p>You can upload your own privacy policy under 'Site Builder &gt; Documents'. In here you can state how and what personal data you collect and how you store, what you do with it, i.e. your purpose and which third parties you share the data with.</p>

        <h3>Leagues must comply with the GDPR "Individual Rights"</h3>

        <p class="bold">Right to be informed</p>
        <p>This can be implemented in the league's privacy policy.</p>
        <p>If the league uses the {{ env('APP_NAME', 'Badminton.io') }} Player Registration system then consent can be obtained by requiring league members to accept the league's terms / privacy policy when registering for the league.</p>

        <p class="bold">Right of access</p>
        <p>Individuals have a right to access their personal data. {{ env('APP_NAME', 'Badminton.io') }} provide a web page detailing personal information and related league sports data about an individual which a league can give to that individual.</p>

        <p class="bold">Right to rectification</p>
        <p>All data relating to an individual can be corrected by any League Administrator within a league.</p>

        <p class="bold">Right to erasure</p>
        <p>We provide the tools to completely erase a person in your league. There is no way to revert this. All personal data will be deleted and the player or person will have a first name and last name anonymised.</p>

        <p class="bold">Right to restrict process</p>
        <p>We provide the tools to restrict the processing of an individual. Their personal details will not be viewable within the administration system or the public sites and their first name and last name are anonymised.</p>

        <h2 class="h24px">Where we store your personal data</h2>
        <p>All {{ env('APP_NAME', 'Badminton.io') }} data is stored using "<a href="https://aws.amazon.com/">Amazon Web Services</a> (AWS)", they are a subsidiary of Amazon.com that provides a cloud computing platform for {{ env('APP_NAME', 'Badminton.io') }}. <a href="https://aws.amazon.com/privacy/">AWS Privacy</a></p>
        <p>All passwords are encrypted. The administration pages all operate under https, this means all communications between your browser and the website are encrypted.</p>

        <h2 class="h24px">Use of Intercom Services</h2>
        <p>
            We use third-party analytics services to help understand your usage of our services. In particular, we provide a limited amount of your information (such as your email address and sign-up date) to Intercom, Inc. ("Intercom") and utilize Intercom to collect data for analytics purposes when you visit our website or use our product. Intercom analyzes your use of our website and/or product and tracks our relationship so that we can improve our service to you. We may also use Intercom as a medium for communications, either through email, or through messages within our product(s). As part of our service agreements, Intercom collects publicly available contact and social information related to you, such as your email address, gender, company, job title, photos, website URLs, social network handles and physical addresses, to enhance your user experience.
            For more information on the privacy practices of Intercom, please visit <a href="https://www.intercom.com/terms-and-policies#privacy">Intercom privacy</a>. Intercom's services are governed by Intercom's terms of use which can be found at <a href="https://www.intercom.com/terms-and-policies#terms">Intercom terms</a>.
        </p>

        <h2 class="h24px">Use of Smartlook Services</h2>
        <p>
            We have engaged Smartlook to analyse the user behaviour of visitors to this website and provide research information designed to improve the customer experience. Smartlook's standard use of cookies and other tracking technologies can enable it to have access to Personal Information of visitors to this website. Such access to and use of Personal Information by Inspectlet is governed by <a href="https://help.smartlook.com/en/articles/3244452-privacy-policy">Smartlook's Privacy Policy</a>.
            Note: we do not allow Smartlook to record sensitive information input into our forms such as first name, last name, date of birth, email address or password.
        </p>

        <h2 class="h24px">Use of Amplitude Services</h2>
        <p>
            We use the services of Amplitude, Inc. ("Amplitude") to process our business intelligence data (graphs, dashboards). The data processing takes place on the basis of our legitimate interests (Art. 6 (1) lit. f GDPR) of analysing user behaviour. Amplitude receives a pseudonymized {{ env('APP_NAME', 'Badminton.io') }} ID and interaction data from us for this purpose.
            For more information about data processing by Amplitude, see the <a href="https://amplitude.com/privacy">Amplitude Privacy Policy</a>.
        </p>

        <h2 class="h24px">Cookies</h2>
        <p>This policy gives the following information about cookies:</p>
        <ul>
            <li>what they are;</li>
            <li>which ones are used by www.{{ env('APP_NAME', 'Badminton.io') }}.com ("LR");</li>
            <li>the purposes for which they are used; and</li>
            <li>how you can manage and/or disable them.</li>
        </ul>
        <p>Cookies are small text files which are placed on your device when you visit a website. They contain information that is transferred to your device's hard drive and help us to improve our site and to deliver a better and more personalised service to you. Cookies enable us to:</p>
        <ul>
            <li>estimate our audience size and usage pattern;</li>
            <li>store information about your preferences, and so allow us to customise our site according to your individual interests; and</li>
            <li>recognise you when you return to our site.</li>
        </ul>
        <p>The cookies used on this website have been categorised based on the categories found in the ICC UK Cookie guide. A list of all the cookies used on this website by category is set out below.</p>

        <h3>Category 1 - Strictly Necessary Cookies</h3>

        <p class="bold">These cookies enable services you have specifically asked for.</p>

        <p>These cookies are essential in order to enable you to move around the website and use its features, such as accessing secure areas of the website. Without these cookies, services you require, like results, statistics, standings and news cannot be provided.</p>

        <!-- Cat 1 Cookie Table -->
        <table>
            <thead>
                <tr>
                    <td>Cookie Name</td>
                    <td>Description</td>
                    <td>Expiry</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>JSESSIONID</td>
                    <td>This cookie contains a session ID which is a mechanism for distinguishing different users' visits when multiple users are visiting the website at the same time. It is essential for interactive use of the site.</td>
                    <td>On closing the web browser</td>
                </tr>
            </tbody>
        </table>

        <h3>Category 2 - Performance Cookies</h3>

        <p class="bold">These cookies collect anonymous information about the pages visited by you</p>

        <p>These cookies collect information about how visitors use a website, for instance which pages visitors go to most often, and if they get error messages from web pages. These cookies don't collect information that identifies a visitor. All information these cookies collect is aggregated and therefore anonymous. It is only used to improve how a website works.</p>

        <!-- Cat 2 Cookie Table -->
        <table>
            <thead>
                <tr>
                    <td>Cookie Name</td>
                    <td>Description</td>
                    <td>Expiry</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>__utma</td>
                    <td>This cookie is typically written to the browser upon the first visit to our site from that web browser. If the cookie has been deleted by the browser operator, and the browser subsequently visits our site, a new __utma cookie is written with a different unique ID. This cookie is used to determine unique visitors to our site and it is updated with each page view. Additionally, this cookie is provided with a unique ID that Google Analytics uses to ensure both the validity and accessibility of the cookie as an extra security measure. </td>
                    <td>2 years from set/update</td>
                </tr>
                <tr>
                    <td>__utmb</td>
                    <td>This cookie is used to establish and continue a user session with our site. When a user views a page on our site, the Google Analytics code attempts to update this cookie. If it does not find the cookie, a new one is written and a new session is established. Each time a user visits a different page on our site; this cookie is updated to expire in 30 minutes, thus continuing a single session for as long as user activity continues within 30-minute intervals. This cookie expires when a user pauses on a page on our site for longer than 30 minutes.</td>
                    <td>30 minutes from set/update</td>
                </tr>
                <tr>
                    <td>__utmc</td>
                    <td>This cookie operates in conjunction with the __utmb cookie to determine whether or not to establish a new session for the user. </td>
                    <td>On closing the web browser</td>
                </tr>
                <tr>
                    <td>__utmz</td>
                    <td>This cookie stores the type of referral used by the visitor to reach our site, whether via a direct method, a referring link, a website search, or a campaign such as an ad or an email link. It is used to calculate search engine traffic, ad campaigns and page navigation within our own site. The cookie is updated with each page view to our site. </td>
                    <td>6 months from set/update</td>
                </tr>
            </tbody>
        </table>

        <h3>Category 3 - Functionality Cookies</h3>
        <p class="bold">These cookies remember choices you make to improve your experience.</p>
        <p>We do not use this type of cookie directly on our website.</p>
        <p>We offer a support chat facility on our website via www.whoson.com , please visit their website for details of the <a href="http://www.whoson.com/privacy.aspx" target="_blank">Whoson privacy policy</a></p>

        <h3>Category 4 - Targeting / Advertising Cookies</h3>
        <p class="bold">These cookies collect information about your browsing habits in order to make advertising relevant to you and your interests.</p>
        <p>LR does not directly store cookies related to advertising from our website. We serve adverts via Google DoubleClick for Publishers Small Business and Google Adsense. Please see <a href="http://www.google.com/policies/privacy/ads/" target="_blank">Googles advertising privacy statements</a></p>

        <h3>Restricting and blocking cookies</h3>
        <p>If you wish to restrict or block the cookies which are set by our websites, or any other website, you can do this through your browser settings. The Help function within your browser should tell you how.</p>
        <p>Alternatively, visit www.aboutcookies.org which contains comprehensive information on how to restrict or block the cookies on a wide variety of browsers. This site provides details on how to delete cookies from your computer as well as more general information about cookies.</p>
        <p>For information on how to do this on the browser of your mobile phone you will need to refer to your handset manual.</p>
        <p>Click here to <a href="http://tools.google.com/dlpage/gaoptout" target="_blank">opt out of being tracked by Google Analytics across all websites</a></p>
        <p>Please be aware that restricting cookies may impact on the functionality of our website.</p>
        <p>To obtain further information on the ICC (UK) UK cookie guide visit <a href="http://www.international-chamber.co.uk/our-expertise/digitaleconomy" target="_blank">http://www.international-chamber.co.uk/our-expertise/digitaleconomy</a></p>

        <h2 class="h24px">Changes to our privacy policy</h2>
        <p>Any changes we may make to our privacy policy in the future will be posted on this page. This policy was last updated: <strong>26 September 2022</strong></p>

        <h2 class="h24px">Contact</h2>
        <p>Questions, comments and requests regarding this privacy policy should be addressed to {{ env('APP_NAME', 'Badminton.io') }}, DJH Technology Ltd, Granville House, 2 Tettenhall Rd, Wolverhampton WV1 4SB, United Kingdom or <a class="lowercase" href="#" onclick="Intercom('showNewMessage');return false;">Contact Us</a></p>

    </div>
</section>
@endsection
