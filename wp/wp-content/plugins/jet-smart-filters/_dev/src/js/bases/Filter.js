import eventBus from 'includes/event-bus';

export default class Filter {
	dataValue = false;

	applySelector = '.apply-filters';
	applyButtonSelector = '.apply-filters__button';
	filtersGroupSelector = '.jet-filters-group';

	constructor($filter, $container = false) {
		this.$container = $container;
		this.$filter = $filter;
		this.provider = this.$filter.data('content-provider');
		this.additionalProviders = this.$filter.data('additional-providers');
		this.filterId = this.$filter.data('filterId');
		this.queryId = this.$filter.data('queryId') || 'default';
		this.queryType = this.$filter.data('queryType');
		this.queryVar = this.$filter.data('queryVar');
		this.queryVarSuffix = this.$filter.data('queryVarSuffix');
		this.applyType = this.$filter.data('applyType') || 'ajax';
		this.layoutOptions = this.$filter.data('layoutOptions');
		this.redirect = this.$filter.data('redirect');
		this.redirectPath = this.$filter.data('redirectPath');
		this.activeLabel = this.$filter.data('activeLabel');
		this.isMixed = this.applyType.indexOf('mixed') !== -1 ? true : false;
		this.isReload = this.applyType === 'reload' ? true : false;
		this.isReloadType = this.applyType.indexOf('reload') !== -1 ? true : false;
		this.$applyButton = $();

		if (this.$container) {
			if (this.$container.next(this.applySelector).length) {
				this.$applyButton = this.$container.next(this.applySelector).find(this.applyButtonSelector);
			} else if (this.$container.closest(this.filtersGroupSelector).length) {
				this.$applyButton = this.$container.closest(this.filtersGroupSelector).next(this.applySelector).find(this.applyButtonSelector);
			}
		}

		if (typeof this.queryId !== 'string')
			this.queryId = this.queryId.toString();

		if (this.activeLabel)
			this.activeLabel += ':&nbsp;';
	}

	initEvent() {
		if (this.isReloadType) {
			this.addApplyEvent();
		} else {
			this.addFilterChangeEvent();
		}
	}

	removeEvent() {
		this.removeChangeEvent();
		this.$applyButton.off();
	}

	addApplyEvent() {
		this.$applyButton.on('click', () => {
			this.processData();
			this.emitFiterChange();
		})
	}

	reset() {
		this.dataValue = false;
	}

	show() {
		this.$container.removeClass('hide');
	}

	hide() {
		this.$container.addClass('hide');
	}

	isCurrentProvider(filter = { provider: false, queryId: false }) {
		return filter.provider === this.provider && filter.queryId === this.queryId ? true : false;
	}

	isAdditionalProvider(filter = { provider: false, queryId: false }) {
		const {
			provider = false,
			queryId = 'default'
		} = filter;

		if (!provider)
			return false;

		return this.additionalProviders.includes(provider + '/' + queryId) ? true : false;
	}

	// emitters
	emitFiterChange() {
		eventBus.publish('fiter/change', this);
	}

	emitFitersApply() {
		eventBus.publish('fiters/apply', this);
	}

	emitFitersRemove() {
		eventBus.publish('fiters/remove', this);
	}

	// Getters
	get data() {
		return this.dataValue || false;
	}

	get queryKey() {
		const queryVarSuffix = this.queryVarSuffix;
		let key;

		key = '_' + this.queryType + '_' + this.queryVar;

		if (queryVarSuffix)
			key += '|' + queryVarSuffix;

		return key
	}

	get enabled() {
		return this.$filter.is(':visible');
	}

	get copy() {
		return Object.assign(Object.create(Object.getPrototypeOf(this)), this);
	}

	// abstract methods
	addFilterChangeEvent() {
		return false;
	}

	removeChangeEvent() {
		return false;
	}

	processData() {
		return false;
	}

	setData() {
		return false;
	}

	get activeValue() {
		return false;
	}
}