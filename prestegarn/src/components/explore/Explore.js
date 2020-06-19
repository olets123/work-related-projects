import React, { Component } from "react";
/* import { getFriends } from "../objects/friendsObject.js"; */
import { getFriends } from "../../handlers/friendHandler.js";
import ExploreElement from "./exploreEle/exploreElement.js";
import "../../style/Explore.css";

/**
 * explore component is run when the url is = /venner
 */
class Explore extends Component {
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      friendObj: []
    };
  }
  componentDidMount() {
    getFriends().then(
      data => {
        this.setState({
          isLoaded: true,
          friendObj: data
        });
      },
      error => {
        this.setState({
          isLoaded: true,
          error
        });
      }
    );
  }
  render() {
    const { error, isLoaded, friendObj } = this.state;
    if (error) {
      return (
        <div>
          <div className="friendBox">
            <h1 className="header">Våre bestevenner</h1>
          </div>
          <div>Error: {error.message}</div>
        </div>
      );
    } else if (!isLoaded) {
      return (
        <div>
          <div className="friendBox">
            <h1 className="header">Våre bestevenner</h1>
          </div>
          <div>Laster inn...</div>
        </div>
      );
    } else {
      var exploreObj = friendObj;
      var exploreList = exploreObj.map(explore => {
        return (
          <ExploreElement
            key={explore.friendId}
            name={explore.name}
            desc={explore.description}
            imgSrc={explore.picture_url}
            imgAlt={explore.picture_alt}
            fLink={explore.facebookLink}
            iLink={explore.instagramLink}
            mail={explore.email}
            phone={explore.contact_phone}
            contact={explore.contact_name}
          />
        );
      });
      var friendIntroText =
        "Her kan du lese om Præstgar'n sine venner i Snertingdal!\nNoen av disse kan du finne som samarbeidspartnere på arrangementer vi holder!\nMens noen andre er venner i Snertingdal som vi mener fortjener mer oppmerksomhet!";
      return (
        <div>
          <div className="friendBox">
            <h1 className="header">Våre bestevenner</h1>
            <div className="introWrapper">
              <p className="intro">{ friendIntroText }</p>
            </div>
            <div className="friendContent">{exploreList}</div>
          </div>
        </div>
      );
    }
  }
}
export default Explore;
