<div id="search" ng-controller="rb-rooms.SearchController" rut-detect-mobile="rut-detect-mobile" class="search ng-scope">

	<!-- FILTROS -->
	<div id="filters" ng-controller="rb-search.FilterController" ng-class="{ 'filters--open': showFilters }" class="ng-scope">
		<div class="filters filters--collapse new-search">
			<div ng-hide="showFilters" class="panel clearfix visible-xs"><a href="#" ng-click="showFilters = true" class="btn btn-rb btn-rb-medium btn-primary btn-block">Mostrar Filtros</a>
			</div>
			<form serialize="search" submit-for="nextPage" action="/search/" method="get" ng-class="{ 'show': showFilters }" class="clearfix ng-pristine ng-valid">
				<div class="panel clearfix visible-xs"><a href="#" ng-click="showFilters = false" class="btn btn-rb btn-rb-medium btn-primary btn-block">Cerrar Filtros</a>
				</div>
				<div class="colr-sm-3 panel">
					<fieldset class="filter-listing-type">
						<div class="panel-content">
							<div class="btn-group btn-group-justified btn-group-toggle btn-group--rooms"><a type="button" ng-click="toggleListingType('sale')" ng-class="{ active: less.listing_type['sale'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
								<input type="checkbox" name="listing_type" ng-checked="less.listing_type['sale']" value="sale">Venta</a><a type="button" ng-click="toggleListingType('rent')" ng-class="{ active: less.listing_type['rent'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch active">
								<input type="checkbox" name="listing_type" ng-init="less.listing_type['rent'] = true" ng-checked="less.listing_type['rent']" value="rent" checked="checked">Alquiler</a>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="colr-sm-4 panel filter-no-padding">
					<fieldset class="filter-price">
						<div class="panel-content">
							<div view-range-selector="view-range-selector" floor="0" ceil="10000" start="None" end="None" step="500" symbol-prefix="'$'" symbol-suffix="''" placeholder="'Price'" floor-variable="search.price.min" ceil-variable="search.price.max" watch-variable="search.price.options" truncated-label="true" class="rbRangeSelector ng-isolate-scope">
								<div ng-class="{open:dropdown_2}" class="dropdown open">
									<div class="range-input-field">
										<div class="range-form-control">
											<input ng-model="range.min" placeholder="Min Price" class="range-first-input form-control ng-pristine ng-valid ng-touched" style="opacity: 0;">
											<div ng-hide="range.min" style="color: #ccc;" class="form-control ng-binding">Precio Min</div>
										</div>
										<div class="range-form-control">
											<input ng-model="range.max" placeholder="Max Price" class="range-second-input form-control ng-pristine ng-valid ng-touched" style="opacity: 0;">
											<div ng-hide="range.max" style="color: #ccc;" class="form-control ng-binding">Precio Max</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="colr-sm-6 panel">
					<fieldset class="filter-bedrooms">
						<div class="panel-content">
							<div class="btn-group btn-group-justified btn-group-toggle btn-group--rooms">
								<a type="button" ng-if="1 != -1 || (1 == -1 &amp;&amp; !less.listing_type['sale'])" ng-click="toggleRooms('1')" ng-class="{ active: less.rooms['1'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ng-scope">
								<input type="checkbox" name="rooms" ng-checked="less.rooms['1']" value="1">1 Hab.</a>
								<a type="button" ng-if="2 != -1 || (2 == -1 &amp;&amp; !less.listing_type['sale'])" ng-click="toggleRooms('2')" ng-class="{ active: less.rooms['2'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ng-scope">
								<input type="checkbox" name="rooms" ng-checked="less.rooms['2']" value="2">2 Hab.</a>
								<a type="button" ng-if="3 != -1 || (3 == -1 &amp;&amp; !less.listing_type['sale'])" ng-click="toggleRooms('3')" ng-class="{ active: less.rooms['3'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ng-scope">
								<input type="checkbox" name="rooms" ng-checked="less.rooms['3']" value="3">3 Hab.</a>
								<a type="button" ng-if="4 != -1 || (4 == -1 &amp;&amp; !less.listing_type['sale'])" ng-click="toggleRooms('4')" ng-class="{ active: less.rooms['4'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ng-scope">
								<input type="checkbox" name="rooms" ng-checked="less.rooms['4']" value="4">4 Hab.</a>
								<a type="button" ng-if="0 != -1 || (0 == -1 &amp;&amp; !less.listing_type['sale'])" ng-click="toggleRooms('0')" ng-class="{ active: less.rooms['0'] }" class="btn btn-primary btn-xs btn-block btn-rb-switch ng-scope">
								<input type="checkbox" name="rooms" ng-checked="less.rooms['0']" value="0">5+ Hab.</a>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="colr-sm-3 panel hide">
					<fieldset ng-controller="rb-rooms.SortController" class="filter-sort ng-scope">
						<div dropdown="dropdown" ng-class="{open: dropdown.sort}" class="dropdown">
							<div ng-click="dropdown.sort=false" class="backdrop"></div>
							<a href="#" ng-click="dropdown.sort=!dropdown.sort" class="btn btn-primary btn-xs btn-block btn-rb-dropdown">Sorted by:&nbsp;<b ng-bind="sort.selected.label" class="ng-binding">Relevance</b> ▾</a>
							<ul style="width:100%;" class="dropdown-menu">
								<!-- ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Relevance</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Lowest Price</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Highest Price</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Lowest Floor Area</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Highest Floor Area</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Lowest Land Area</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Highest Land Area</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Lowest PSF (price-per-sqft)</li>
								<!-- end ngRepeat: option in sortOptions -->
								<li ng-repeat="option in sortOptions" ng-click="sortBy(option); dropdown.sort=false" class="text-center ng-binding ng-scope">Highest PSF (price-per-sqft)</li>
								<!-- end ngRepeat: option in sortOptions -->
							</ul>
						</div>
					</fieldset>
				</div>
				<div class="panel panel--dropdown pull-left filter-no-padding">
					<fieldset class="filter-more">
						<div dropdown="dropdown" ng-class="{open:dropdown}" class="dropdown">
							<div ng-click="dropdown=false" class="backdrop"></div>
							<a style="min-width: 125px" href="#" ng-click="dropdown=!dropdown" ng-class="{ 'text-accent': moreSelected() > 0 }" class="btn btn-primary btn-xs btn-block btn-rb-dropdown">Mas Filtros<span ng-show="moreSelected() > 0" class="text-accent ng-hide ng-binding"> (0)</span>
							▾</a>
							<ul class="dropdown-menu">
								<li>
									<div>
										<fieldset class="panel panel--padding">
											<div class="panel-content">
												<label><span>Tipo de Propiedad</span>
												</label>
												<div class="btn-group btn-group-justified btn-group-toggle">
													<a type="button" ng-click="toggleCategoryRadio('hdb')" ng-class="{ active: more.main_category == 'hdb' }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
														<input type="checkbox" name="main_category" ng-checked="more.main_category == 'hdb'" value="hdb">Casa
													</a>
													<a type="button" ng-click="toggleCategoryRadio('condo')" ng-class="{ active: more.main_category == 'condo' }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
														<input type="checkbox" name="main_category" ng-checked="more.main_category == 'condo'" value="condo">Departamento
													</a>
													<a type="button" ng-click="toggleCategoryRadio('landed')" ng-class="{ active: more.main_category == 'landed' }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
														<input type="checkbox" name="main_category" ng-checked="more.main_category == 'landed'" value="landed">Oficina
													</a>
													<a type="button" ng-click="toggleCategoryRadio('landed')" ng-class="{ active: more.main_category == 'landed' }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
														<input type="checkbox" name="main_category" ng-checked="more.main_category == 'landed'" value="landed">Local Comercial
													</a>
													<a type="button" ng-click="toggleCategoryRadio('landed')" ng-class="{ active: more.main_category == 'landed' }" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
														<input type="checkbox" name="main_category" ng-checked="more.main_category == 'landed'" value="landed">Terreno
													</a>
												</div>
												<div ng-class="{ 'arrow-box--first': more.main_category == 'hdb' }" ng-show="more.main_category == 'hdb'" class="arrow-box arrow-box--light holds-input ng-hide">
													<div style="margin-bottom: -5px;" class="checklist clearfix">
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="hdb_2r" ng-disabled="more.main_category != 'hdb'" ng-init="search.sub_categories['hdb_2r'] = true" ng-model="search.sub_categories['hdb_2r']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>HDB 2 room</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="hdb_3r" ng-disabled="more.main_category != 'hdb'" ng-init="search.sub_categories['hdb_3r'] = true" ng-model="search.sub_categories['hdb_3r']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>HDB 3 room</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="hdb_4r" ng-disabled="more.main_category != 'hdb'" ng-init="search.sub_categories['hdb_4r'] = true" ng-model="search.sub_categories['hdb_4r']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>HDB 4 room</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="hdb_5r" ng-disabled="more.main_category != 'hdb'" ng-init="search.sub_categories['hdb_5r'] = true" ng-model="search.sub_categories['hdb_5r']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>HDB 5 room</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="hdb_executive" ng-disabled="more.main_category != 'hdb'" ng-init="search.sub_categories['hdb_executive'] = true" ng-model="search.sub_categories['hdb_executive']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Executive HDB</span>
															</label>
														</div>
													</div>
												</div>
												<div ng-class="{ 'arrow-box--second': more.main_category == 'condo' }" ng-show="more.main_category == 'condo'" class="arrow-box arrow-box--light holds-input ng-hide">
													<div style="margin-bottom: -5px;" class="checklist clearfix">
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="generic_condo" ng-disabled="more.main_category != 'condo'" ng-init="search.sub_categories['generic_condo'] = true" ng-model="search.sub_categories['generic_condo']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Condominium</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="condo_apartment" ng-disabled="more.main_category != 'condo'" ng-init="search.sub_categories['condo_apartment'] = true" ng-model="search.sub_categories['condo_apartment']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Apartment</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="walkup" ng-disabled="more.main_category != 'condo'" ng-init="search.sub_categories['walkup'] = true" ng-model="search.sub_categories['walkup']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Walk up</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="executive_condo" ng-disabled="more.main_category != 'condo'" ng-init="search.sub_categories['executive_condo'] = true" ng-model="search.sub_categories['executive_condo']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Executive Condominium</span>
															</label>
														</div>
													</div>
												</div>
												<div ng-class="{ 'arrow-box--third': more.main_category == 'landed' }" ng-show="more.main_category == 'landed'" class="arrow-box arrow-box--light holds-input ng-hide">
													<div style="margin-bottom: -5px;" class="checklist clearfix">
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="terraced_house" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['terraced_house'] = true" ng-model="search.sub_categories['terraced_house']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Terrace House</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="corner_terrace" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['corner_terrace'] = true" ng-model="search.sub_categories['corner_terrace']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Corner Terrace</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="semi_detached" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['semi_detached'] = true" ng-model="search.sub_categories['semi_detached']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Semi-Detached House</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="bungalow" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['bungalow'] = true" ng-model="search.sub_categories['bungalow']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Bungalow House</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="goodclass_bungalow" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['goodclass_bungalow'] = true" ng-model="search.sub_categories['goodclass_bungalow']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Good Class Bungalow</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="shophouse" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['shophouse'] = true" ng-model="search.sub_categories['shophouse']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Shophouse</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="conservationhouse" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['conservationhouse'] = true" ng-model="search.sub_categories['conservationhouse']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Conservation House</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="townhouse" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['townhouse'] = true" ng-model="search.sub_categories['townhouse']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Town House</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="landonly" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['landonly'] = true" ng-model="search.sub_categories['landonly']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Land Only</span>
															</label>
														</div>
														<div class="col-sm-6 property-sub-type">
															<label>
															<input type="checkbox" checked="checked" name="sub_categories" value="clusterhouse" ng-disabled="more.main_category != 'landed'" ng-init="search.sub_categories['clusterhouse'] = true" ng-model="search.sub_categories['clusterhouse']" class="ng-pristine ng-untouched ng-valid" disabled="disabled"><span>Cluster House</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</fieldset>
										<fieldset class="panel panel--padding">
											<div class="panel-content">
												<label><span>Superficie</span>
												</label>
												<input id="floor-price-pad" type="hidden" ng-value="search.floor_area.min" name="floor_area_min" ng-hide="true" class="range-field col-xs-3 floor ng-hide">
												<input id="ceil-price-pad" type="hidden" ng-value="search.floor_area.max" name="floor_area_max" ng-hide="true" class="range-field col-xs-3 ceil ng-hide">
												<div view-range-selector="view-range-selector" floor="0" ceil="10000" start="None" end="None" step="500" symbol-prefix="''" symbol-suffix="'sqft'" placeholder="'Size'" floor-variable="search.floor_area.min" ceil-variable="search.floor_area.max" watch-variable="search.floor_area.options" class="rbRangeSelector ng-isolate-scope">
													<!-- a. removed the dropdown directive to allow the parent scope to control the dropdown--><!-- .dropdown(ng-class='{open:dropdown_2}')--><!--  .backdrop(ng-click='dropdown_2=!dropdown_2;backdropClicked()')--><!--  a.btn.btn-primary.btn-xs.btn-block.btn-rb-dropdown(href='#', ng-click='dropdown_2=!dropdown_2;dropdownClicked()')--><!--    span(ng-cloak)--><!--      | {! label !}--><!--    |  ▾--><!-- ul.dropdown-menu.range-selector-dropdown--><!--   li--><!--     div--><!--       fieldset.panel--><!--         .panel-content-->
													<div ng-class="{open:dropdown_2}" class="dropdown">
														<div ng-click="dropdown_2=!dropdown_2;backdropClicked()" class="backdrop"></div>
														<div class="range-input-field">
															<div class="range-form-control">
																<input ng-model="range.min" placeholder="Min Size" class="range-first-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.min" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Min&nbsp;</span> sqft</div>
																<div ng-hide="range.min" style="color: #ccc;" class="form-control ng-binding">Min</div>
															</div>
															<div class="range-form-control">
																<input ng-model="range.max" placeholder="Max Size" class="range-second-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.max" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Max&nbsp;</span> sqft</div>
																<div ng-hide="range.max" style="color: #ccc;" class="form-control ng-binding">Max</div>
															</div>
														</div>
														<ul class="dropdown-menu range-selector-dropdown">
															<li>
																<div>
																	<fieldset class="panel">
																		<div class="panel-content">
																			<div class="range-input-label"><label class="ng-binding"></label></div>
																			<div class="range-input-list">
																				<ul ng-show="currentInput == &quot;MIN&quot;" class="range-input-list-element range-input-list-minimum ng-hide">
																					<!-- ngRepeat: o in options.min -->
																				</ul>
																				<ul ng-show="currentInput == &quot;MAX&quot;" class="range-input-list-element range-input-list-maximum ng-hide">
																					<!-- ngRepeat: o in options.max -->
																				</ul>
																			</div>
																		</div>
																	</fieldset>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</fieldset>
										<fieldset ng-show="more.main_category == 'landed'" class="panel panel--padding ng-hide">
											<div class="panel-content">
												<label><span>Land Size</span>
												</label>
												<input id="floor-price-pad" ng-disabled="more.main_category != 'landed'" ng-value="search.land.min" name="land_area_min" ng-hide="true" type="hidden" class="range-field col-xs-3 floor ng-hide" disabled="disabled">
												<input id="ceil-price-pad" ng-disabled="more.main_category != 'landed'" ng-value="search.land.max" name="land_area_max" ng-hide="true" type="hidden" class="range-field col-xs-3 ceil ng-hide" disabled="disabled">
												<div view-range-selector="view-range-selector" floor="0" ceil="10000" start="None" end="None" step="500" symbol-prefix="''" symbol-suffix="'sqft'" placeholder="'Size'" floor-variable="search.land.min" ceil-variable="search.land.max" watch-variable="search.land.options" class="rbRangeSelector ng-isolate-scope">
													<!-- a. removed the dropdown directive to allow the parent scope to control the dropdown--><!-- .dropdown(ng-class='{open:dropdown_2}')--><!--  .backdrop(ng-click='dropdown_2=!dropdown_2;backdropClicked()')--><!--  a.btn.btn-primary.btn-xs.btn-block.btn-rb-dropdown(href='#', ng-click='dropdown_2=!dropdown_2;dropdownClicked()')--><!--    span(ng-cloak)--><!--      | {! label !}--><!--    |  ▾--><!-- ul.dropdown-menu.range-selector-dropdown--><!--   li--><!--     div--><!--       fieldset.panel--><!--         .panel-content-->
													<div ng-class="{open:dropdown_2}" class="dropdown">
														<div ng-click="dropdown_2=!dropdown_2;backdropClicked()" class="backdrop"></div>
														<div class="range-input-field">
															<div class="range-form-control">
																<input ng-model="range.min" placeholder="Min Size" class="range-first-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.min" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Min&nbsp;</span> sqft</div>
																<div ng-hide="range.min" style="color: #ccc;" class="form-control ng-binding">Min Size</div>
															</div>
															<div class="range-form-control">
																<input ng-model="range.max" placeholder="Max Size" class="range-second-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.max" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Max&nbsp;</span> sqft</div>
																<div ng-hide="range.max" style="color: #ccc;" class="form-control ng-binding">Max Size</div>
															</div>
														</div>
														<ul class="dropdown-menu range-selector-dropdown">
															<li>
																<div>
																	<fieldset class="panel">
																		<div class="panel-content">
																			<div class="range-input-label"><label class="ng-binding"></label></div>
																			<div class="range-input-list">
																				<ul ng-show="currentInput == &quot;MIN&quot;" class="range-input-list-element range-input-list-minimum ng-hide">
																					<!-- ngRepeat: o in options.min -->
																				</ul>
																				<ul ng-show="currentInput == &quot;MAX&quot;" class="range-input-list-element range-input-list-maximum ng-hide">
																					<!-- ngRepeat: o in options.max -->
																				</ul>
																			</div>
																		</div>
																	</fieldset>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</fieldset>
										<fieldset ng-show="less.listing_type['sale'] &amp;&amp; (more.main_category == 'condo' || more.main_category == 'landed')" class="panel panel--padding ng-hide">
											<div class="panel-content">
												<label><span>Tenure</span>
												</label>
												<div data-toggle="buttons" class="btn-group btn-group-justified btn-group-toggle"><a type="button" style="text-transform:" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
													<input ng-disabled="!less.listing_type['sale'] || (more.main_category != 'condo' &amp;&amp; more.main_category != 'landed')" type="checkbox" name="tenure" ng-checked="more.tenure == 'freehold'" value="freehold" disabled="disabled">Freehold</a><a type="button" style="text-transform:" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
													<input ng-disabled="!less.listing_type['sale'] || (more.main_category != 'condo' &amp;&amp; more.main_category != 'landed')" type="checkbox" name="tenure" ng-checked="more.tenure == '99_103'" value="99_103" disabled="disabled">99 to 103 Years</a><a type="button" style="text-transform:" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
													<input ng-disabled="!less.listing_type['sale'] || (more.main_category != 'condo' &amp;&amp; more.main_category != 'landed')" type="checkbox" name="tenure" ng-checked="more.tenure == '999'" value="999" disabled="disabled">999 Years</a>
												</div>
											</div>
										</fieldset>
										<fieldset ng-show="more.main_category == 'hdb' || more.main_category == 'condo'" class="panel panel--padding ng-hide">
											<div class="panel-content">
												<label><span>Age of Development</span>
												</label>
												<input id="floor-price-pad" ng-disabled="more.main_category != 'hdb' &amp;&amp; more.main_category != 'condo'" ng-value="search.age.min" name="completed_after" type="hidden" ng-hide="true" class="range-field col-xs-3 floor ng-hide" disabled="disabled">
												<input id="ceil-price-pad" ng-disabled="more.main_category != 'hdb' &amp;&amp; more.main_category != 'condo'" ng-value="search.age.max" name="completed_before" ng-hide="true" type="hidden" class="range-field col-xs-3 ceil ng-hide" disabled="disabled">
												<div view-range-selector="view-range-selector" floor="1960" ceil="2020" start="None" end="None" step="1" symbol-prefix="''" symbol-suffix="''" placeholder="'Year'" floor-variable="search.age.min" ceil-variable="search.age.max" watch-variable="search.age.options" ignore-thousands="true" class="rbRangeSelector ng-isolate-scope">
													<!-- a. removed the dropdown directive to allow the parent scope to control the dropdown--><!-- .dropdown(ng-class='{open:dropdown_2}')--><!--  .backdrop(ng-click='dropdown_2=!dropdown_2;backdropClicked()')--><!--  a.btn.btn-primary.btn-xs.btn-block.btn-rb-dropdown(href='#', ng-click='dropdown_2=!dropdown_2;dropdownClicked()')--><!--    span(ng-cloak)--><!--      | {! label !}--><!--    |  ▾--><!-- ul.dropdown-menu.range-selector-dropdown--><!--   li--><!--     div--><!--       fieldset.panel--><!--         .panel-content-->
													<div ng-class="{open:dropdown_2}" class="dropdown">
														<div ng-click="dropdown_2=!dropdown_2;backdropClicked()" class="backdrop"></div>
														<div class="range-input-field">
															<div class="range-form-control">
																<input ng-model="range.min" placeholder="Min Year" class="range-first-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.min" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Min&nbsp;</span> </div>
																<div ng-hide="range.min" style="color: #ccc;" class="form-control ng-binding">Min Year</div>
															</div>
															<div class="range-form-control">
																<input ng-model="range.max" placeholder="Max Year" class="range-second-input form-control ng-pristine ng-untouched ng-valid">
																<div ng-show="range.max" class="form-control primary-subtext ng-binding ng-hide"><span class="range-label">Max&nbsp;</span> </div>
																<div ng-hide="range.max" style="color: #ccc;" class="form-control ng-binding">Max Year</div>
															</div>
														</div>
														<ul class="dropdown-menu range-selector-dropdown">
															<li>
																<div>
																	<fieldset class="panel">
																		<div class="panel-content">
																			<div class="range-input-label"><label class="ng-binding"></label></div>
																			<div class="range-input-list">
																				<ul ng-show="currentInput == &quot;MIN&quot;" class="range-input-list-element range-input-list-minimum ng-hide">
																					<!-- ngRepeat: o in options.min -->
																				</ul>
																				<ul ng-show="currentInput == &quot;MAX&quot;" class="range-input-list-element range-input-list-maximum ng-hide">
																					<!-- ngRepeat: o in options.max -->
																				</ul>
																			</div>
																		</div>
																	</fieldset>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</fieldset>
										<fieldset class="panel panel--padding">
											<div class="panel-content form-group">
												<label class="control-label"><span>Contains Keywords</span>
												</label>
												<div class="input-group col-xs-12">
													<input name="keywords" type="text" ng-model="search.keywords" style="width:100%;border-radius:2px;" placeholder="Keywords separated by spaces: gym high floor" ng-init="search.keywords = ''" class="form-control ng-pristine ng-untouched ng-valid">
												</div>
											</div>
										</fieldset>
									</div>
								</li>
							</ul>
						</div>
					</fieldset>
				</div>
				<div class="panel pull-left filter-create-alert">
					<button rro-create-alert="rro-create-alert" style="padding-top: 2px; padding-bottom: 2px;" track="Clicked Create Alert" tr-eval="{'Load Origin':'Filter Bar', 'Button Text': 'Create Alert'}" type="button" class="btn btn-rb btn-rb-medium btn-primary col-xs-max ng-scope">
						<div class="fa fa-search"></div>
						Buscar
					</button>
				</div>
			</form>
		</div>
	</div>
	<!-- FIN FILTROS -->

	<!-- RESULTADOS -->
	<div id="grid" rut-router="ContentRouter" ng-controller="rb-rooms.ContentController" class="rui-view rui-view--container ng-scope">
		<div ng-controller="rb-rooms.GridController" ng-init="showListView = false" class="ng-scope">
			<div rui-view="grid" scroll-to="0" scroll-on="'search.fetch.success'" class="rui-view grid-list ng-scope">
				<div ng-controller="rb-listing.MassSmsController" class="default-grid default-grid--checkboxes ng-scope">
					<div ng-controller="rb-map.UpdatePointController" style="margin-bottom: 0px; padding: 7px; background-color: #7a7a7a;" class="panel visible-xs ut-no-radius ng-scope">
						<fieldset>
							<div ng-controller="rb-rooms.SearchAutocompleteController" class="panel-content search-group ng-scope">
								<span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
									<input type="text" value="Buscar" prevent-default="prevent-default" rui-typeahead="rui-typeahead" rut-clear-input-on-focus="rut-clear-input-on-focus" bh-options="bloodhoundOptions" ta-options="typeaheadOptions" ta-datasets="typeaheadDatasets" bh-callback="suggestionsFound" ta-callback="placeSelected" track="Clicked Search" tr-eval="{'Load Origin':'Search Filters', 'Input Bar Text':'Search by Address, Landmark, or MRT'}" class="form-control input--search ng-isolate-scope tt-hint" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255);"><input type="text" placeholder="Search by Address, Landmark, or MRT" value="Singapore" prevent-default="prevent-default" rui-typeahead="rui-typeahead" rut-clear-input-on-focus="rut-clear-input-on-focus" bh-options="bloodhoundOptions" ta-options="typeaheadOptions" ta-datasets="typeaheadDatasets" bh-callback="suggestionsFound" ta-callback="placeSelected" track="Clicked Search" tr-eval="{'Load Origin':'Search Filters', 'Input Bar Text':'Search by Address, Landmark, or MRT'}" class="form-control input--search ng-isolate-scope tt-input" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
									<pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizeLegibility; text-transform: none;"></pre>
									<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;">
										<div class="tt-dataset-0"></div>
									</span>
								</span>
							</div>
						</fieldset>
					</div>
					<div class="content-section grid-results clearfix">
						<div class="content-body text-center ut-pb-10">
							<h1 class="h4 primary-text marginless"><b class="text-dark-blue">32346</b>
								propiedades en Mendoza
							</h1>
						</div>
						<div class="content-body clearfix ut-pt-0">
							<div class="grid-results-summary text-left pull-left">
								<div ng-controller="rb-rooms.SortController" class="filters ng-scope">
									<fieldset class="filter-sort">
										<div dropdown="dropdown" ng-class="{open: sort.dropdown}" class="dropdown">
											<div ng-click="sort.dropdown=false" class="backdrop"></div>
											<a href="#" ng-click="sort.dropdown=!sort.dropdown" class="btn btn-primary btn-transparent btn-xs btn-block btn-rb-dropdown">Ordenar por:&nbsp;<b ng-bind="sort.selected.label" class="ng-binding">Cercanìa</b> ▾</a>
											<ul style="width:100%;" class="dropdown-menu">
												<!-- ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Cercanìa</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Precio</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Highest Price</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Lowest Floor Area</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Highest Floor Area</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Lowest Land Area</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Highest Land Area</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Lowest PSF (price-per-sqft)</li>
												<!-- end ngRepeat: option in sortOptions -->
												<li ng-repeat="option in sortOptions" ng-click="sort.dropdown=false; sendSortSignal(option);" class="text-center ng-binding ng-scope">Highest PSF (price-per-sqft)</li>
												<!-- end ngRepeat: option in sortOptions -->
											</ul>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
					<div class="content-body clearfix">
						<div class="text-left pull-left">
							<h5 class="ut-mt-5 ut-mb-5 ut-fw-normal">Pàgina<b> 1</b>
								de<b> 10</b>
							</h5>
						</div>
					</div>
					<ul ng-hide="showListView" class="clearfix list-inline list-unstyled list--server-rendered unit-cards-container unit-cards--paginate">
						<li rut-name="unit" rut-model="{ id: 'QkzAGFofWSj5AdGRD459j', location: {development: 'jsnmjx9CDUCgRDEtYiiMfe'} }" rut-model-scope="rut-model-scope" class="ng-scope">
							<div ng-controller="rb-rooms.UnitCardController" rut-emit="machine.event('unit.clicked')" rut-emit-data="{ model: unit }" rut-emit-default="true" ng-mouseenter="mouseEnterUnit()" ng-mouseleave="mouseLeaveUnit()" class="clearfix card-link unit-card content-island ng-scope">
								<div class="content-island-content">
									<div class="checklist clearfix">
										<label>
										<input type="checkbox" ng-model="selectedUnits['QkzAGFofWSj5AdGRD459j']" ng-init="selectedUnits['QkzAGFofWSj5AdGRD459j'] = false" ng-change="unitToggled('QkzAGFofWSj5AdGRD459j')" class="ng-pristine ng-untouched ng-valid"><span style="text-transform: none;"></span>
										</label>
									</div>
									<a target="_blank" href="/singapore/rent/listings/the-lakeshore-condo-QkzAGFofWSj5AdGRD459j">
										<div class="photo-carousel clearfix background-container image-text-wrapper">
											<div id="room-photo-display" style="background-image: url('/bebusca/img/estates/1.jpg');" class="room-photo-main background-responsive"></div>
											<div class="overlay-bottom">
												<div class="fill-with bottom-black-gradient"></div>
												<div class="overlay-photos-total">
													<i class="fa fa-picture-o">&nbsp;</i><span>14</span>
												</div>
												<div class="overlay-bedrooms-total">
													<i class="fa fa-bed">&nbsp;</i><span>2</span>
												</div>
												<div class="overlay-unit-title">
													<p class="hide-overflow">The Lakeshore, 31 Jurong West Street 41</p>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</li>

						<li rut-name="unit" rut-model="{ id: 'QkzAGFofWSj5AdGRD459j', location: {development: 'jsnmjx9CDUCgRDEtYiiMfe'} }" rut-model-scope="rut-model-scope" class="ng-scope">
							<div ng-controller="rb-rooms.UnitCardController" rut-emit="machine.event('unit.clicked')" rut-emit-data="{ model: unit }" rut-emit-default="true" ng-mouseenter="mouseEnterUnit()" ng-mouseleave="mouseLeaveUnit()" class="clearfix card-link unit-card content-island ng-scope">
								<div class="content-island-content">
									<div class="checklist clearfix">
										<label>
										<input type="checkbox" ng-model="selectedUnits['QkzAGFofWSj5AdGRD459j']" ng-init="selectedUnits['QkzAGFofWSj5AdGRD459j'] = false" ng-change="unitToggled('QkzAGFofWSj5AdGRD459j')" class="ng-pristine ng-untouched ng-valid"><span style="text-transform: none;"></span>
										</label>
									</div>
									<a target="_blank" href="/singapore/rent/listings/the-lakeshore-condo-QkzAGFofWSj5AdGRD459j">
										<div class="photo-carousel clearfix background-container image-text-wrapper">
											<div id="room-photo-display" style="background-image: url('/bebusca/img/estates/2.jpg');" class="room-photo-main background-responsive"></div>
											<div class="overlay-bottom">
												<div class="fill-with bottom-black-gradient"></div>
												<div class="overlay-photos-total">
													<i class="fa fa-picture-o">&nbsp;</i><span>14</span>
												</div>
												<div class="overlay-bedrooms-total">
													<i class="fa fa-bed">&nbsp;</i><span>2</span>
												</div>
												<div class="overlay-unit-title">
													<p class="hide-overflow">The Lakeshore, 31 Jurong West Street 41</p>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</li>

					</ul>

					<div class="content content--padding">
						<div style="margin-top: 0px;" class="pagination-wrapper">
							<div class="pagination pull-right">
								<ul class="list-inline">
									<li><span class="current">1</span>
									</li>
									<li><a href="/search/singapore" target="_self" rut-emit="'page.clicked'" rut-emit-data="{page: 2, url: '/search/singapore'}" track="Clicked Page" tr-eval="{'Page':'2'}">2</a>
									</li>
									<li><a href="/search/singapore" target="_self" rut-emit="'page.clicked'" rut-emit-data="{page: 3, url: '/search/singapore'}" track="Clicked Page" tr-eval="{'Page':'3'}">3</a>
									</li>
									<li>
										<span class="continuation">…</span>
									</li>
									<li><a href="/search/singapore" target="_self" rut-emit="'page.clicked'" rut-emit-data="{page: 1618, url: '/search/singapore'}" track="Clicked Page" tr-eval="{'Page':'1618'}">1618</a>
									</li>
									<li><a href="/search/singapore" rel="next" target="_self" rut-emit="'page.clicked'" rut-emit-data="{page: 2, url: '/search/singapore'}" track="Clicked Next Page">›</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FIN RESULTADOS -->

	<!-- MAPA -->
	<div id="map" style="background-color: #e5e3df">
		<div id="map" ng-controller="rb-rooms.MapController" ng-class="{ 'map-untouched': mapUntouched, 'map-cluster-open': clusterOpen, 'map--limit-commute': map.mapLimit == 'commute' }">
			<div id="map-canvas" class="map-canvas"></div>
			<div class="map-header">
				<div class="map-header-content">
					<div class="map-zoom no-select">
						<div ng-click="zoom(true)"><i class="fa fa-plus"></i>
						</div>
						<div class="border"></div>
						<div ng-click="zoom(false)"><i class="fa fa-minus"></i>
						</div>
					</div>
					<div class="map-location">
						<div class="panel filter-criteria filter-location" style="float:left;width:60%;">
							<fieldset>
								<div class="panel-content search-group">
									<input type="text" placeholder="Busqueda por dirección" value="Mendoza" class="form-control input--search input--map-search" />
								</div>
							</fieldset>
						</div>
						<div class="draw-zone panel filter-criteria filter-location" style="float:left;width:40%;">
							<div class="btn-group btn-group-justified btn-group-toggle btn-group--rooms" style="height:41px;">
								<a id="draw-editable-region" type="button" class="btn btn-primary btn-xs btn-block btn-rb-switch">
									<input type="checkbox"><span class="fa fa-pencil c-white icon-left"></span>&nbsp;Dibujar zona
								</a>
								<a id="delete-editable-region" type="button" class="btn btn-primary btn-xs btn-block btn-rb-switch active">
									<input type="checkbox"><span class="fa fa-times c-white icon-left"></span>&nbsp;Borrar zona
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FIN MAPA -->
</div>