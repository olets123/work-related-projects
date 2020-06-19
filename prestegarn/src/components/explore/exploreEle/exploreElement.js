import React, { Component } from "react";
var logos = require.context("../../../images/logo", true);

/**
 * Div that contains information about one friend
 */
class ExploreElement extends Component {
  state = {};
  render() {
    let cTag = "bestFriends";
    return (
      <div className={cTag}>
        <div className="friendTextBox">
          <h1 className="sub_header friendTitle">{this.props.name}</h1>
          <div className="friendText">
            <p>{this.props.desc}</p>
            <div className="contactInfo">
              <i className="fas fa-address-book" />
              <p>{this.props.contact}</p>
              <i className="fas fa-phone" />
              <p>{this.props.phone}</p>
            </div>
            <div className="socialMedia friendSocialMedia">
              <a href={this.props.fLink}>
                <i className="fab fa-facebook-f" />
              </a>
              <a href={this.props.iLink}>
                <i className="fab fa-instagram" />
              </a>
              <a href={"mailto: " + this.props.mail}>
                <i className="fas fa-envelope" />
              </a>
            </div>
          </div>
          
        </div>
        <div className="imageContainer">
          <img
            className="friendImage"
            src={logos(`./${this.props.imgSrc}`)}
            alt={this.props.imgAlt}
          />
        </div>
      </div>
    );
  }
}

export default ExploreElement;
