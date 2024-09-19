@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Terms & Conditions') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Terms & Conditions') }}</h1>
    </div>
</section>

<section id="terms" class="container">
    <div>
        <p class="wcs-page_body">
            {{ __('At all times Badminton.io reserves the right to suspend or terminate accounts') }}
            {{ __('where, at the discretion of Badminton.io these services are deemed to have been inappropriately used.') }}
        </p>
        <p class="">{{ 'Badminton.io reserves the right to amend and update these Terms and Conditions at any time without notice.' }}</p>

        <h6 class="h24px">{{ __('1. Content') }}</h6>

        <p class="wcs-page_body">{{ __('You are entirely responsible for the content of your Web pages.') }}
            {{ __('The following content may not be stored or made available on Badminton.io') }}:
        </p>

        <ol class="wcs-page_body">
            <li>{{ __('Copyrighted material, unless the owner has granted consent.') }}</li>

            <li>{{ __('Unlawful content which violates any law, regulation, or order. This includes,but is not limited to: obscene or pornographic material; defamatory, fraudulent,
                or deceptive statements; threatening, intimidating or harassing statements.') }}
            </li>

            <li>{{ __('Indecent or objectionable content including both pornographic and verbal
                obscenities which, even if lawful,Badminton.io may, at its sole discretion,
                deem harmful to theBadminton.io reputation and brand image.') }}</li>

            <li>{{ __('Warez links and files.') }}</li>

            <li>{{ __('Adverts for ad networks e.g.') }} Google Adsense</li>
        </ol>

        <p class="wcs-page_body">{{ __('Links, banners and any information regarding how to obtain access to the
            above will also be regarded as in violation of this condition.') }}</p>

        <p class="wcs-page_body">{{ __('As the owner of the Web page content, you will be solely responsible for
            any libellous or defamatory statements published resulting in any form of
            consequence. In addition, you will be responsible for our reasonable legal
            costs incurred in defending any defamation or libel action caused by your
            page content. You also agree to indemnify Badminton.io for any damages awarded
            against our company or its employees in a court of law or as a settlement
            action upon Counsel`s advice.') }}</p>

        <p>{{ __('Badminton.io reserves the right to place adverts on the web pages of clients
            using the free service. Current policy is to place relevant Google adverts
            for leagues with a significant traffic volume and cover the free service costs.') }}</p>

        <h6 class="h24px">{{ __('2. General Usage') }}</h6>

        <p  class="wcs-page_body">{{ __('You must be 16 years or over to have an account i.e. a sign-in to') }} {{ env('APP_NAME', 'Badminton.io') }}</p>

        <p  class="wcs-page_body">{{ __('If you run a league or club then your league or club must be GDPR compliant and must respond to all "Individual Rights" requests') }}</p>

        <p  class="wcs-page_body">{{ __('You are responsible for any misuse of your account, even if a friend, family
            member, guest or employee has committed the inappropriate activity. Therefore,
            you must take steps to ensure that others do not gain access to your account.') }}</p>

        <p  class="wcs-page_body">{{ __('You agree to keep secure your user ID, password and other confidential information
            provided by') }} {{ env('APP_NAME', 'Badminton.io') }}.</p>

        <p  class="wcs-page_body">{{ __('You agree not to break or attempt to break security on') }} {{ env('APP_NAME', 'Badminton.io') }}{{ __(' system,
            or to access an account which does not belong to you.') }}</p>

        <p  class="wcs-page_body">{{ __('You agree not to screen scrape data from') }} {{ env('APP_NAME', 'Badminton.io') }} {{ __('sites to store elsewhere or display on other websites.') }}</p>

        <h6 class="h24px">{{ __('3. Electronic Mail Facility') }}</h6>

        <p  class="wcs-page_body">{{ __('Misuse of the e-mail facility may result in suspension and/or termination of your Web site.') }}</p>

        <p  class="wcs-page_body">{{ __('The following is a guideline of what constitutes misuse:') }}</p>

        <ol  class="wcs-page_body">
            <li>{{ __('Sending unsolicited bulk or commercial messages ("spam"). This
                includes, but is not limited to, bulk mailing of commercial advertising, informational
                announcements, charity requests, petitions for signatures, and political or
                religious tracts. Such messages may only be sent to those who have explicitly
                requested them.') }}</li>
            <li>{{ __('You may not use electronic mail to harass or intimidate others.') }}</li>
        </ol>

        <h6 class="h24px">{{ __('4. Payment and Charges') }}</h6>

        <p  class="wcs-page_body">{{ __('In the event of default of payment of Badminton.io paid services,') }}
            {{ __('reserves the right to suspend the Service provided to the Customer without
            refund.') }}</p>

        <h6 class="h24px">{{ __('5. Cancellation, Termination and Access') }}</h6>

        <p  class="wcs-page_body">{{ __('Upon termination of your account, all files (including Web pages, images,
            etc.) will be deleted.') }}</p>

        <p  class="wcs-page_body">{{__('Badminton.io reserves the right to terminate your contract at any time,
            with or without cause, upon reasonable notice.') }}</p>

        <p  class="wcs-page_body">{{__('Badminton.io expressly reserves the right to suspend your Web site immediately
            should you fail to comply with the terms and conditions provided by Badminton.io') }}.</p>

        <p  class="wcs-page_body">{{ __('Should Badminton.io terminate this contract with cause, or should you terminate
            your contract, you will not be entitled to any refund in respect of any unused portion.') }}</p>

        <p  class="wcs-page_body">{{ __('Either party may cancel if the other commits any material breach of any of
            these conditions or where a breach being remedied has not been remedied within
            a reasonable time period as may be specified in a formal request in writing
            or by e-mail to remedy the same. In some cases, the customer may be entitled
            to a pro-rata refund of services paid excluding any set-up charges.') }}</p>

        <p  class="wcs-page_body">{{ __('If there is dispute over the users which have access to an account, Badminton.io
            has the decision over who will be granted access. Sites are set up in the interests of a league club and
            the decision will be based in the interest of the league or club.') }}</p>

        <h6 class="h24px">{{ __('6. Indemnity') }}</h6>

        <p  class="wcs-page_body">{{ __('You, the customer agree to fully indemnify and keep Badminton.io its employees,
            affiliates, and partners, fully indemnified from and against all actions,
            demands, costs, losses, penalties, damages, liability, claims and expenses
            (including but not limited to legal fees) whatsoever arising from your breach
            of any contract with Badminton.io your use or misuse of any services provided
            by Badminton.io or its affiliates, any claims by third parties as to ownership
            or any other rights to ownership or arising in any way by the client infringing
            (whether innocently or knowingly) third party rights (including without limit
            intellectual property rights).') }}</p>

        <h6 class="h24px">{{ __('7. Liability') }}</h6>

        <p  class="wcs-page_body">{{__('Badminton.io may from time to time close down the whole or part of the
            system for routine repair, maintenance work or for emergency repair. Badminton.io shall at its sole discretion decide when such action is necessary.') }}</p>

        <p  class="wcs-page_body">{{ __('You, The Customer acknowledge that Badminton.io may exercise editorial
            control over the content of its system, but Badminton.io does not have the
            resources, nor is it capable of checking the full content thereof at all times.
            The Customer further acknowledges that Badminton.io its agents, contractors,
            licensees, employees and information providers providing Services are unable
            to exercise control over the content of the Internet; and Badminton.io therefore
            excludes all liability of any kind for defamation and the transmission or
            reception of material of whatever nature other than information inserted by Badminton.io specifically excludes any warranty as to the
            quality, content or accuracy of information received through or as a result
            of the use of the Services.') }}
        </p>

        <p  class="wcs-page_body">{{ __('Badminton.io does not warrant that the functions contained in these Web
            pages or the Internet Web site will meet the client of requirements or that
            the operation of the Web pages will be uninterrupted or error-free. The entire
            risk as to the quality and performance of the Web pages and Web site is with
            the client.') }}</p>

        <p  class="wcs-page_body">{{ __('In no event will Badminton.io be liable to the client or any third party
            for any damages, including any lost profits, lost savings or other incidental,
            consequential or special damages arising out of the operation of or inability
            to operate these Web pages or Web site, even if Badminton.io has been advised
            of the possibility of such damages.') }}</p>

        <p  class="wcs-page_body">{{ __('If any provision of this agreement shall be unlawful, void, or for any reason
            unenforceable, then that provision shall be deemed severable from this agreement
            and shall not affect the validity and enforceability of any remaining provisions.') }}</p>

        <h6 class="h24px">{{ __('8. The Law') }}</h6>

        <p  class="wcs-page_body">
            {{ __('English Law governs this agreement and both parties agree to the exclusive
            jurisdiction of the English courts.') }}</p>

    </div>
</section>
@endsection
