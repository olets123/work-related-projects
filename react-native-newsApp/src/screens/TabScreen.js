import React, { Component } from 'react';
import { Container, Header, Left, Body, Right, Title, Tab, Tabs } from 'native-base';
import Tab1 from '../tabs/tab1.js';
import Tab2 from '../tabs/tab2.js';
import Tab3 from '../tabs/tab3.js';

export default class TabScreen extends Component {
  render() {
    return (
      <Container>
        <Header style={{backgroundColor:'black'}} hasTabs>
            <Left/>
          <Body>
            <Title style={{color:'white'}}>World of News</Title>
          </Body>
          <Right />
        </Header>
        <Tabs tabBarUnderlineStyle={{backgroundColor:'red'}}>
          <Tab tabStyle={{backgroundColor:'black'}} activeTabStyle={{backgroundColor:'black'}} textStyle={{color:'white'}} activeTextStyle={{color:'white'}} heading="General News">
            <Tab1 />
          </Tab>
          <Tab tabStyle={{backgroundColor:'black'}} activeTabStyle={{backgroundColor:'black'}} textStyle={{color:'white'}} activeTextStyle={{color:'white'}} heading="Business News">
            <Tab2 />
          </Tab>
          <Tab tabStyle={{backgroundColor:'black'}} activeTabStyle={{backgroundColor:'black'}} textStyle={{color:'white'}} activeTextStyle={{color:'white'}} heading="Technology News">
            <Tab3 />
          </Tab>
        </Tabs>
      </Container>
    );
  }
}