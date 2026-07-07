"use client";
import { Contacts } from "../Contacts";
import { Logo } from "../Logo";
import { Nav } from "../Nav";
import styles from "./Footer.module.scss";

export const Footer = () => {
  return (
    <section className={styles.footer}>
      <div className={styles.footerTop}>
        <Logo />
        <Nav />
        <Contacts />
      </div>
      <div className={styles.footerBottom}>
        <div className={styles.left}>
          <p>
            © 2026 ООО «Киберия», номер в реестре <br /> аккредитованных IT-компаний: 53278
          </p>
        </div>
        <div className={styles.middle}>Реквизиты компании</div>
        <div className={styles.right}>Политика конфиденциальности</div>
      </div>
    </section>
  );
};
