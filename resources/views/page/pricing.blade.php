@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('About') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Pricing') }}</h1>
        <p class="center">{{ __('Options for all league sizes and needs. ') }}</p>
    </div>
    <div class="tabs">
        <div class="container">
            <ul>
                <li class="active"><a href="#" data-plan="plan-small">Up to <strong>25 Teams</strong></a></li>
                <li><a href="#" data-plan="plan-medium">Up to <strong>100 Teams</strong></a></li>
                <li><a href="#" data-plan="plan-large">Up to <strong>300 Teams</strong></a></li>
                <li><a href="#" data-plan="plan-unlimited">More than <strong>300 Teams</strong></a></li>
            </ul>
        </div>
    </div>
    <div class="mobile-tabs">
        <div class="container center">
            <select id="plan-size-selector">
                <option value="plan-small">For up to 25 Teams</option>
                <option value="plan-medium">For up to 100 Teams</option>
                <option value="plan-large">For up to 300 Teams</option>
                <option value="plan-unlimited">For more than 300 Teams</option>
            </select>
        </div>
    </div>
</section>

<section class="container">
    <span class="most-popular-message">{{ __('Most popular') }}</span>

    <div id="pricing-currency">
        <select id="currency-selector">
            <option value="currencyUSD">USD $</option>
        </select>
    </div>

    <div id="pricing-table">
        <ul class="labels">
            <li><img src="{{ asset('svg/pricing.svg') }}" alt="Pricing" width="212" height="195"></li>
            <li class="subheading">Top Features</li>
            <li class="summary"></li>
            <li class="subheading">All Features</li>
            <li>Create unlimited divisions and tournaments</li>
            <li>Scheduling tools</li>
            <li>Match conflict checking</li>
            <li>Flexible scoring system</li>
            <li>Enter results via the web</li>
            <li>Get your own league website</li>
            <li>Site builder tools</li>
            <li>Free LeagueRepublic domain</li>
            <li>Unlimited hosting and web storage</li>
            <li>Free support every step of the way</li>
            <li>Switch between two languages on your website</li>
            <li>Player statistics recording and display</li>
            <li>Player registrations and payment systems</li>
            <li>Player profiles</li>
            <li>Social media news and results posts</li>
            <li>Match statistics history</li>
            <li>Show live scores as they happen</li>
            <li>
                <div>
                    SMS result entry (UK leagues only) <i class="help"><span>Requires additional purchase of SMS result entry prompt bundles</span></i>
                </div>
            </li>
            <li>Referee assignment system</li>
            <li>Download league data</li>
            <li>Player suspension system</li>
            <li>Referee marks entry and display</li>
            <li>Referee result entry and match reports</li>
            <li>Add sponsors to your website</li>
            <li>Add custom widgets to your website</li>
            <li>Upload your own header image</li>
            <li>Remove all advertisements</li>
            <li>
                <div>
                    Use your own domain name <i class="help"><span>If you do not already own a domain name then you will need to purchase one from a domain registrar website</span></i>
                </div>
            </li>
            <li>
                <div>
                    Use web integration features <i class="help"><span>Use Code Snippets and the LeagueRepublic API to display league data your own website or app</span></i>
                </div>
            </li>
            <li>Customize the website menu</li>
            <li>Create your own custom pages</li>
            <li>Upload your own background image</li>
            <li>Upload your own favicon</li>
            <li class="subheading">Add-ons</li>

            <li>SMS Result Entry Prompt Bundles (UK leagues only)</li>

            <li>Team and Player Registration Fees</li>
        </ul>
        <ul>
            <li class="center">
                <div>
                    <div class="plan-title">Free</div>
                    <div class="plan-currency currencyGBP">
                        <div class="plan-price plan-small">£0</div>
                        <div class="plan-price plan-medium" style="display:none;">£0</div>
                        <div class="plan-price plan-large" style="display:none;">£0</div>
                        <div class="plan-price plan-unlimited" style="display:none;">£0</div>
                    </div>

                    <div class="plan-currency currencyEUR" style="display:none;">
                        <div class="plan-price plan-small">€0</div>
                        <div class="plan-price plan-medium" style="display:none;">€0</div>
                        <div class="plan-price plan-large" style="display:none;">€0</div>
                        <div class="plan-price plan-unlimited" style="display:none;">€0</div>
                    </div>

                    <div class="plan-currency currencyUSD" style="display:none;">
                        <div class="plan-price plan-small">$0</div>
                        <div class="plan-price plan-medium" style="display:none;">$0</div>
                        <div class="plan-price plan-large" style="display:none;">$0</div>
                        <div class="plan-price plan-unlimited" style="display:none;">$0</div>
                    </div>

                    <div class="plan-billing">
                        per month
                    </div>
                    <div>
                        <a href="https://a.leaguerepublic.com/myaccount/createAccount/1.html?lver=1" class="button">Get started</a>
                    </div>
                </div>
            </li>
            <li class="subheading"></li>
            <li class="summary center">
                <ul>
                    <li>Everything you need to run a basic league</li>
                </ul>
            </li>
            <li class="subheading"></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Create unlimited divisions and tournaments</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Scheduling tools</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match conflict checking</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Flexible scoring system</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Enter results via the web</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Get your own league website</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Site builder tools</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free LeagueRepublic domain</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Unlimited hosting and web storage</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free support every step of the way</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Switch between two languages on your website</span></li>
            <li class="subheading"></li>
            <li></li>
            <li></li>
        </ul>
        <ul>
            <li class="center">
                <div>
                    <div class="plan-title bronze">Bronze</div>
                    <div class="plan-currency currencyGBP">
                        <div class="plan-price plan-small">£6<span>.80</span></div>
                        <div class="plan-price plan-medium" style="display:none;">£12<span>.20</span></div>
                        <div class="plan-price plan-large" style="display:none;">£23<span>.20</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">£34<span>.10</span></div>
                    </div>

                    <div class="plan-currency currencyEUR" style="display:none;">
                        <div class="plan-price plan-small">€8<span>.20</span></div>
                        <div class="plan-price plan-medium" style="display:none;">€14<span>.80</span></div>
                        <div class="plan-price plan-large" style="display:none;">€27<span>.80</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">€40<span>.70</span></div>
                    </div>

                    <div class="plan-currency currencyUSD" style="display:none;">
                        <div class="plan-price plan-small">$9<span>.10</span></div>
                        <div class="plan-price plan-medium" style="display:none;">$16<span>.20</span></div>
                        <div class="plan-price plan-large" style="display:none;">$30<span>.40</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">$44<span>.90</span></div>
                    </div>

                    <div class="plan-billing">
                        per month
                    </div>
                    <div>
                        <a href="https://a.leaguerepublic.com/myaccount/createAccount/1.html?lver=1" class="button">Start free trial</a>
                    </div>
                </div>
            </li>
            <li class="subheading"></li>
            <li class="summary center">
                <ul>
                    <li>Add statistics</li>
                    <li>Register players</li>
                    <li>Auto social media posts</li>
                </ul>
            </li>
            <li class="subheading"></li>
            <li class="center mobile mobile-summary">Everything in <span class="badge free">Free</span> plus</li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Create unlimited divisions and tournaments</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Scheduling tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match conflict checking</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Flexible scoring system</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Enter results via the web</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Get your own league website</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Site builder tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free LeagueRepublic domain</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Unlimited hosting and web storage</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free support every step of the way</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Switch between two languages on your website</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player statistics recording and display</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player registrations and payment systems</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player profiles</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Social media news and results posts</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match statistics history</span></li>
            <li class="center mobile">
                <strong>Add-ons</strong>
                <br><br>Team and Player Registration Fees
                <br><small>LeagueRepublic fees are just <strong>2%</strong> per transaction with no setup fees, <a rel="noopener" target="_blank" href="https://stripe.com/pricing">Stripe fees</a> vary by country and currency but are always highly competitive.</small>
            </li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li class="subheading"></li>

            <li></li>

            <li class="span3 desktop">
                <div class="center">
                    LeagueRepublic fees are just <strong>2%</strong> per transaction with no setup fees, <a rel="noopener" target="_blank" href="https://stripe.com/pricing">Stripe fees</a> vary by country and currency but are always highly competitive.
                </div>
            </li>
        </ul>
        <ul>
            <li class="center">
                <div>
                    <div class="plan-title silver">Silver</div>
                    <div class="plan-currency currencyGBP">
                        <div class="plan-price plan-small">£10<span>.90</span></div>
                        <div class="plan-price plan-medium" style="display:none;">£17<span>.70</span></div>
                        <div class="plan-price plan-large" style="display:none;">£34<span>.10</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">£51<span>.90</span></div>
                    </div>

                    <div class="plan-currency currencyEUR" style="display:none;">
                        <div class="plan-price plan-small">€13</div>
                        <div class="plan-price plan-medium" style="display:none;">€21<span>.30</span></div>
                        <div class="plan-price plan-large" style="display:none;">€40<span>.70</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">€62</div>
                    </div>

                    <div class="plan-currency currencyUSD" style="display:none;">
                        <div class="plan-price plan-small">$14<span>.50</span></div>
                        <div class="plan-price plan-medium" style="display:none;">$23<span>.30</span></div>
                        <div class="plan-price plan-large" style="display:none;">$44<span>.90</span></div>
                        <div class="plan-price plan-unlimited" style="display:none;">$68</div>
                    </div>

                    <div class="plan-billing">
                        per month
                    </div>
                    <div>
                        <a href="https://a.leaguerepublic.com/myaccount/createAccount/1.html?lver=1" class="button">Start free trial</a>
                    </div>
                </div>
            </li>
            <li class="subheading"></li>
            <li class="summary center">
                <ul>
                    <li>Results via SMS</li>
                    <li>Manage referees</li>
                    <li>Download league data</li>
                </ul>
            </li>
            <li class="subheading"></li>
            <li class="center mobile mobile-summary">Everything in <span class="badge bronze">Bronze</span> plus</li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Create unlimited divisions and tournaments</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Scheduling tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match conflict checking</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Flexible scoring system</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Enter results via the web</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Get your own league website</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Site builder tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free LeagueRepublic domain</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Unlimited hosting and web storage</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free support every step of the way</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Switch between two languages on your website</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player statistics recording and display</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player registrations and payment systems</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player profiles</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Social media news and results posts</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match statistics history</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Show live scores as they happen</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>SMS result entry (UK leagues only)</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee assignment system</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Download league data</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player suspension system</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee marks entry and display</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee result entry and match reports</span></li>
            <li class="center mobile">
                <strong>Add-ons</strong>
                <br>
                <br>SMS Result Entry Prompt Bundles (UK leagues only)
                <br><small><strong>£0.057</strong> per text message
                    <br>(Bundles start from £5.70 for 100 SMS text messages)</small>
                <br>
            </li>
            <li class="subheading"></li>

            <li class="span2 desktop">
                <div class="center">
                    <strong>£0.057</strong> per text message<br>(Bundles start from £5.70 for 100 SMS text messages)
                </div>
            </li>

            <li class="desktop"></li>
        </ul>
        <ul>
            <li class="center">
                <div>
                    <div class="plan-title gold">Gold</div>



                    <div class="plan-currency currencyGBP">

                        <div class="plan-price plan-small">£13<span>.60</span></div>

                        <div class="plan-price plan-medium" style="display:none;">£23<span>.20</span></div>

                        <div class="plan-price plan-large" style="display:none;">£46<span>.40</span></div>

                        <div class="plan-price plan-unlimited" style="display:none;">£68<span>.30</span></div>
                    </div>



                    <div class="plan-currency currencyEUR" style="display:none;">

                        <div class="plan-price plan-small">€16<span>.50</span></div>

                        <div class="plan-price plan-medium" style="display:none;">€27<span>.80</span></div>

                        <div class="plan-price plan-large" style="display:none;">€55<span>.50</span></div>

                        <div class="plan-price plan-unlimited" style="display:none;">€81<span>.40</span></div>
                    </div>



                    <div class="plan-currency currencyUSD" style="display:none;">

                        <div class="plan-price plan-small">$17<span>.90</span></div>

                        <div class="plan-price plan-medium" style="display:none;">$30<span>.40</span></div>

                        <div class="plan-price plan-large" style="display:none;">$60<span>.90</span></div>

                        <div class="plan-price plan-unlimited" style="display:none;">$89<span>.60</span></div>
                    </div>


                    <div class="plan-billing">
                        per month
                    </div>
                    <div>
                        <a href="https://a.leaguerepublic.com/myaccount/createAccount/1.html?lver=1" class="button">Start free trial</a>
                    </div>
                </div>
            </li>
            <li class="subheading"></li>
            <li class="summary center">
                <ul>
                    <li>No ads</li>
                    <li>Use own domain</li>
                    <li>More website customization</li>
                </ul>
            </li>
            <li class="subheading"></li>
            <li class="center mobile mobile-summary">Everything in <span class="badge silver">Silver</span> plus</li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Create unlimited divisions and tournaments</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Scheduling tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match conflict checking</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Flexible scoring system</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Enter results via the web</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Get your own league website</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Site builder tools</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free LeagueRepublic domain</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Unlimited hosting and web storage</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Free support every step of the way</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Switch between two languages on your website</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player statistics recording and display</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player registrations and payment systems</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player profiles</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Social media news and results posts</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Match statistics history</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Show live scores as they happen</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>SMS result entry (UK leagues only)</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee assignment system</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Download league data</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Player suspension system</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee marks entry and display</span></li>
            <li class="center desktop"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Referee result entry and match reports</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Add sponsors to your website</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Add custom widgets to your website</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Upload your own header image</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Remove all advertisements</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Use your own domain name</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Use web integration features</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Customize the website menu</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Create your own custom pages</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Upload your own background image</span></li>
            <li class="center"><img src="{{ asset('svg/icon-tick.svg') }}" alt="checked icon" width="20" height="20"><span>Upload your own favicon</span></li>
            <li class="center mobile"></li>
            <li class="subheading"></li>
            <li class="desktop"></li>
            <li class="desktop"></li>
        </ul>
    </div>
</section>

<section id="faqs" class="container">
    <h2 class="center h28px">Frequently Asked Questions</h2>
    <dl class="faq">
        <dt>
            <button>What's the commitment?</button>
        </dt>
        <dd>
            <p>
                Our plans give you 1 - 12 months service. You can upgrade your plan at any time during this period. Plans do not auto-renew but we will remind you 1 month before your current plan is due to expire.
            </p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>What happens if I exceed the maximum number of teams in my plan size?</button>
        </dt>
        <dd>
            <p>
                We will contact you if your league contains more teams than your plan allows. We will then either reduce your plan length or you can upgrade to the next size up.
            </p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>How do you calculate the number of teams in a league?</button>
        </dt>
        <dd>
            <p>The total team count is the total number of unique teams in divisions in the default season. We don't count singles, doubles or triples teams or normal teams in tournaments. If you are still in the process of creating teams for the season then make sure that you choose a plan that will allow for the final number of teams in your league.</p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>Do you offer free trials?</button>
        </dt>
        <dd>
            <p>Yes. You can start a trial at any time without any payment information. You get 14 days to try out all of the features.</p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>Can I pay monthly?</button>
        </dt>
        <dd>
            <p>Yes. We currently offer 1 - 12 month plans, please note that these plans do not auto-renew.</p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>What payment methods do you support?</button>
        </dt>
        <dd>
            <p>We accept all major debit and credit cards from customers in every country.</p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>Can I handle multiple league sites with one Sign In?</button>
        </dt>
        <dd>
            <p>Yes. You can create as many league websites as you want and access them all from one LeagueRepublic account.</p>
        </dd>
    </dl>
    <dl class="faq">
        <dt>
            <button>I have more than one league website that I want to upgrade, do I need to purchase multiple plans?</button>
        </dt>
        <dd>
            <p>Yes. Our pricing applies to each league website, however, you can create multiple divisions and tournaments within one league.</p>
        </dd>
    </dl>
</section>
@endsection
