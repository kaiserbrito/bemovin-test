FROM ruby:2.4-alpine

ENV BUILD_PACKAGES="curl-dev ruby-dev build-base" \
    DEV_PACKAGES="zlib-dev libffi-dev libxml2-dev libxslt-dev tzdata yaml-dev mysql-dev" \
    RUBY_PACKAGES="ruby ruby-io-console ruby-json yaml nodejs" \
    PORT="3001"

RUN apk --update --upgrade add $BUILD_PACKAGES $RUBY_PACKAGES $DEV_PACKAGES

WORKDIR /app

COPY Gemfile .

COPY . /app

RUN bundle install

CMD ["rails", "s", "-b", "0.0.0.0", "-p", "3000"]
