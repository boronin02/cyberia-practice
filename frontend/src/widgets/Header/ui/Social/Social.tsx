import Image from "next/image";
import styles from "./Social.module.scss";
import { useContext } from "react";
import { HeaderTheme } from "../../lib/HeaderTheme";
import { HeaderContext } from "../../lib/HeaderContext";

import {
  maxLogoWhite,
  maxLogo,
  tgLogoWhite,
  tgLogo,
  vkLogoWhite,
  vkLogo,
} from "@/shared/assets/images/header";

export const Social = () => {
  const theme = useContext(HeaderContext);
  return (
    <>
      {theme === HeaderTheme.Dark ? (
        <>
          <div className={styles.social}>
            <Image alt="tgLogoWhite" src={tgLogoWhite} width={32} height={32} />
            <Image alt="maxLogoWhite" src={maxLogoWhite} width={32} height={32} />
            <Image alt="vkLogoWhite" src={vkLogoWhite} width={32} height={32} />
          </div>
        </>
      ) : (
        <>
          <div className={styles.social}>
            <Image alt="tgLogo" src={tgLogo} width={32} height={32} />
            <Image alt="maxLogo" src={maxLogo} width={32} height={32} />
            <Image alt="vkLogo" src={vkLogo} width={32} height={32} />
          </div>
        </>
      )}
    </>
  );
};
