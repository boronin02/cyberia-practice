import Image from "next/image";
import { useContext } from "react";
import { HeaderContext } from "../../lib/HeaderContext";
import { HeaderTheme } from "../../lib/HeaderTheme";
import styles from "./Logo.module.scss";

import { logo, logoWhite } from "@/shared/assets/images/header";

export const Logo = () => {
  const theme = useContext(HeaderContext);
  return (
    <div className={styles.logo}>
      {theme === HeaderTheme.Dark ? (
        <Image
          src={logoWhite}
          alt="logo"
          fill
          sizes="(max-width: 480px) 120px, (max-width: 768px) 150px, 174px"
          className={styles.logoImage}
        />
      ) : (
        <Image
          src={logo}
          alt="logo"
          fill
          sizes="(max-width: 480px) 120px, (max-width: 768px) 150px, 174px"
          className={styles.logoImage}
        />
      )}
    </div>
  );
};
