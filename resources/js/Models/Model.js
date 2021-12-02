export default class Model {
  primaryKey = 'id';

  constructor(attributes) {
    this.fill(attributes);
  }

  defaults() {
    return {};
  }

  formData() {
    return this;
  }

  fill(attributes) {
    const defaults = this.defaults();
    for (const name in defaults) {
      this.setAttribute(name, attributes ? attributes[name] : null, defaults[name]);
    }
  }

  setAttribute(name, value, defaultValue) {
    this[name] = this.parseAttribute(value, defaultValue);
  }

  parseAttribute(value, defaultValue) {
    if (value === 0 || value === null || value === false) {
      return value;
    }

    if (defaultValue instanceof Function) {
      return defaultValue.make(value);
    }

    if (Array.isArray(defaultValue)) {
      if (value === []) {
        return null;
      }

      return Array.isArray(value) ? value.map(item => {
        return this.parseAttribute(item, defaultValue[0]);
      }) : [];
    }

    return value;
  }

  is(model) {
    if (!(model instanceof Model)) {
      return false;
    }

    return this[this.primaryKey] === model[model.primaryKey] && this.constructor === model.constructor;
  }

  static make(attributes) {
    return new this(attributes);
  }

  static collection(models) {
    return Array.isArray(models) ? models.map(attributes => {
      return this.make(attributes);
    }) : [];
  }
};
